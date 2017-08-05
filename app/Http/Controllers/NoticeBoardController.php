<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TeacherStudentDetail;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
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
        $this->user=Auth::user();

        $notices=NoticeBoardDetails::where([
            ['Ent_Type','<>','D']
        ])->orderBy('NB_Date')->get();

        $count=NoticeBoardDetails::where([
            ['Ent_Type','<>','D']
        ])->count();

        if($count==0)
            return redirect('/teacher/add-notice')->with('message','No notice to be displayed');

        $author=[];

        foreach ($notices as $notice) {
            # code...
            $author[$notice->id]=DB::table('teacher_student_details')->where('id',$notice->NB_T_Id)->value('T_Stu_Name');
        }

        return view('teachers.notice-board.view_notice_board')->with(['author'=>$author,'notices'=>$notices]);
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

        $this->validate(request(),[
            'NB_Heading'=>'required|max:250',
            'NB_Content'=>'required|max:500',
             
        ]);

        $this->authorize('create',NoticeBoardDetails::class);

        $noticeBoard=new NoticeBoardDetails;

        $noticeBoard->NB_Heading=$request->NB_Heading;
        $noticeBoard->NB_Content=$request->NB_Content;
        $noticeBoard->NB_Date=Carbon::now();
        $noticeBoard->NB_Inst_Id=null;
        $noticeBoard->Ent_Type='I';
        $noticeBoard->Role_Type=$author->Role_Type;
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
        $notice = NoticeBoardDetails::findOrFail($id);

        $this->authorize('view',$notice);

        return view('teachers.notice-board.edit_notice')->with(['notice'=>$notice]);
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
        $notice=NoticeBoardDetails::findOrFail($id);

        $this->authorize('update',$notice);

        $notice->NB_Content=$request->NB_Content;
        $notice->NB_Heading=$request->NB_Heading;
        $notice->Ent_Type='E';

        if($notice->save())
            return redirect('/teacher/check-notice')->with('message','Updated Successfully !');
        else
            return back()->with('message','Could not be updated.Try again');
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
        $notice=NoticeBoardDetails::findOrFail($id);
        $this->authorize('delete',$notice);

        $notice->Ent_Type='D';

        if($notice->save())
            return redirect('/teacher/check-notice')->with('message','Deleted Successfully');
        else
            return redirect('/teacher/check-notice')->with('message','Could not deleted! Try again');
    }
}
