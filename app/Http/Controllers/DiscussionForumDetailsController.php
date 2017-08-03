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
     * Display a listing of the resource.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $discussionTopic = DiscussionForumTopic::findOrFail($id);

        $discussionDetails=DiscussionForumDetails::where([
            ['Ent_Type','<>','D'],
            ['DFD_Topic_Id','=',$id],
        ])->orderBy('DFD_Date','DESC')->get();

        $author=[];

        foreach($discussionDetails as $detail){
            $author[$detail->id]=DB::table('teacher_student_details')->where('id',$detail->DFD_User_Id)->value('T_Stu_Name');
        }

        return view('discussionforum.topic-details')->with(['discussionTopic'=>$discussionTopic,'discussionDetails'=>$discussionDetails,'id'=>$id,'author'=>$author]);


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

        $discussionDetails=new DiscussionForumDetails;
        $discussionDetails->DFD_Details=$request->DFD_Details;
        $discussionDetails->DFD_Date=Carbon::now();
        $discussionDetails->Role_Type=$author->Role_Type;
        $discussionDetails->Ent_Type='I';
        $discussionDetails->DFD_User_Id=$author->id;
        $discussionDetails->DFD_Topic_Id=$id;

        if($discussiondDtails->save())
            return redirect('teachers/discussion-forum/{id}',$id)->with('message','Topic Successfully Added!');
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
        //
    }
}
