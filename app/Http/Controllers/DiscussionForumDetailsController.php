<?php

namespace App\Http\Controllers;

use App\DiscussionForumTopic;
use Illuminate\Http\Request;
use App\DiscussionForumDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; 
use App\TeacherStudentDetail;
use Illuminate\Support\Facades\DB;


class DiscussionForumDetailsController extends Controller
{
    private $user;

    public function getCurrentAuthor()
    {
        $this->user = Auth::user();

        $author = TeacherStudentDetail::where([['T_Stu_Email',$this->user->email]])->first();

        return $author;
    }

    /**
     * Display a post along with comments.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $discussionTopic = DiscussionForumTopic::findOrFail($id);

        $topicAuthor =  DB::table('teacher_student_details')->where('id',$discussionTopic->DFT_User_Id)->value('T_Stu_Name');

        $discussionDetails=DiscussionForumDetails::where([
                                ['Ent_Type','<>','D'],
                                ['DFD_Topic_Id','=',$id],
                            ])->orderBy('DFD_Date')->get();

        $commentAuthors=[];

        foreach($discussionDetails as $detail){
            $commentAuthors[$detail->id] = DB::table('teacher_student_details')->where('id',$detail->DFD_User_Id)->value('T_Stu_Name');
        }

        return view('discussionforum.topic_details')->with(['discussionTopic'=>$discussionTopic,'discussionDetails'=>$discussionDetails,'id'=>$id,'topicAuthor'=>$topicAuthor,'commentAuthors'=>$commentAuthors]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $author=$this->getCurrentAuthor();

        $this->validate(request(),[
            'DFD_Details'=>'required|max:500',
        ]);

        $this->authorize('create',DiscussionForumDetails::class);

        $discussionDetails = new DiscussionForumDetails;
        $discussionDetails->DFD_Details = $request->DFD_Details;
        $discussionDetails->DFD_Date = Carbon::now();
        $discussionDetails->Role_Type = $author->Role_Type;
        $discussionDetails->Ent_Type = 'I';
        $discussionDetails->DFD_User_Id = $author->id;
        $discussionDetails->DFD_Topic_Id = $id;

        if($discussionDetails->save())
            return back()->with('message','Comment successfully posted!!');
        else
            return back()->with('message','Could not post comment. Try again!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $topic_id
     * @param  int  $comment_id
     * @return \Illuminate\Http\Response
     */
    public function edit($topic_id, $comment_id)
    {
        $comment= DiscussionForumDetails::findOrFail($comment_id);

        $this->authorize('view',$comment);

        return view('discussionforum.edit_comments')->with(['topic_id'=>$topic_id,'comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $topic_id
     * @param  int $comment_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $topic_id, $comment_id)
    {
        $comment = DiscussionForumDetails::findOrFail($comment_id);

        $this->authorize('update',$comment);

        $comment->DFD_Details = $request->DFD_Details;
        $comment->Ent_Type='E';
        if($comment->save())
            return redirect()->route('post-detail',$topic_id)->with('message','Comment Updated!');
        else
            return back()->with('message','Could not update comment! Try again later');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $topic_id
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($topic_id,$id)
    {
        $comment = DiscussionForumDetails::findOrFail($id);

        $this->authorize('delete',$comment);

        $comment->Ent_Type='D';
        if ($comment->save())
                return redirect()->route('post-detail',$topic_id)->with('message', 'Comment Deleted!');
            else
                return back()->with('message', 'Could Not Delete Data! Try Again.'); 
    }
}
