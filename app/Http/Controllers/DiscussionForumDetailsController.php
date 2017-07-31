<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //

        $discussiondetails=DiscussionForumDetails::where([
            ['Ent_Type','<>','D'],
            ['DFD_Topic_Id','=',$id],
        ])->orderBy('DFD_Date','DESC')->get();

        $author=[];

        

        return view('discussionforum.details')->with(['discussiondetails'=>$discussiondetails,'id'=>$id]);


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
    public function store(Request $request,$id)
    {
        //
        $author=$this->getCurrentAuthor();

        $this->validate(request(),[
            'DFD_Details'=>'required|max:255',
        ]);

        $discussiondetails=new DiscussionForumDetails;
        $discussiondetails->DFD_Details=$request->DFD_Details;

        $discussiondetails->DFD_Date=Carbon::now();
        $discussiondetails->Role_Type=$author->Role_Type;
        $discussiondetails->Ent_Type='I';
        $discussiondetails->DFD_User_Id=$author->id;
        $discussiondetails->DFD_Topic_Id=$id;

        if($discussiondetails->save())
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
