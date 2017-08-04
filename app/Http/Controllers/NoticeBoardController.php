<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherStudentDetail;
use Illuminate\Support\Facades\Auth; 
use App\NoticeBoardDetails;
use Carbon\Carbon;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $user;

    public function getCurrentAuthor()
    {
        $this->user = Auth::user();

        $author = TeacherStudentDetail::where([['T_Stu_Email',$this->user->email]])->first();

        return $author;
    }

    public function index()
    {
        //show all the notices
        
        return view('teachers.notice-board.view_notice_board');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.notice-board.add_notice');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store notice & redirect to notice-board page
        $author = $this->getCurrentAuthor();

        $noticeBoard=new NoticeBoardDetails;

        $noticeBoard->NB_Heading=$request->NB_Heading;
        $noticeBoard->NB_Content=$request->NB_Content;
        $noticeBoard->NB_Date=Carbon::now();
        $noticeBoard->NB_Inst_Id=null;
        $noticeBoard->Ent_Type='I';
        $noticeBoard->Role_Type='E';
        $noticeBoard->NB_T_Id=$author->id;

        if($noticeBoard->save())
            return back()->with('message','Notice Successfully Added!');
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
        //$notice = find notice
        return view('teachers.notice-board.edit_notice');
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
        //update notice & redirect to notice-board
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //change Ent_Type = 'D' of the particular notice
    }
}
