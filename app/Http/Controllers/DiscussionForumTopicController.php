<?php

namespace App\Http\Controllers;

use App\TeacherStudentDetail;
use Illuminate\Http\Request;
use App\DiscussionForumTopic;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DiscussionForumTopicController extends Controller
{
    private $user;


    public function getCurrentAuthor()
    {
        $this->user = Auth::user();

        $author = TeacherStudentDetail::where([['T_Stu_Email',$this->user->email]])->first();

        return $author;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $topics = DiscussionForumTopic::where('Ent_Type','<>','D')->orderBy('DFT_Date','DESC')->get();

        $authors = [];

        foreach($topics as $id=>$topic)
        {
            $authors[$topic->id] = DB::table('teacher_student_details')->where('id',$topic->DFT_User_Id)->value('T_Stu_Name');
        }
        //dd($authors);
        return view('discussionforum.topics')->with(['topics'=>$topics,'authors'=>$authors]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = $this->getCurrentAuthor();

        $this->validate(request(),[
            'DFT_Topic'=>'required|max:255',
        ]);

        $discussionForumTopic = new DiscussionForumTopic;

        $discussionForumTopic->DFT_Topic = $request->DFT_Topic;
        $discussionForumTopic->DFT_User_Id = $author->id;
        $discussionForumTopic->DFT_Date = Carbon::now();
        $discussionForumTopic->Role_Type = $author->Role_Type;
        $discussionForumTopic->Ent_Type ='I';

        if($discussionForumTopic->save())
            return back()->with('message','Topic Successfully Added!');
        else
            return back()->with('message','Could not add topic. Try again!');


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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $topic=DiscussionForumTopic::findOrFail($id);
        
        return view('discussionforum.edit_topic')->with('topic',$topic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topic=DiscussionForumTopic::findOrFail($id);
        $topic->DFT_Topic=$request->DFT_Topic;
        $topic->Ent_Type='E';
        if($topic->save())
            return redirect('/teacher/discussion-forum')->with('message','Updated Successfully');
        else
            return back()->with('message','Could not update! Try again later'); 
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic=DiscussionForumTopic::findOrFail($id);
        $topic->Ent_Type='D';
        if ($topic->save())
                return back()->with('message', 'Deleted Successfully!');
            else
                return back()->with('message', 'Could Not Delete Data! Try Again.');            
        //
    }
}
