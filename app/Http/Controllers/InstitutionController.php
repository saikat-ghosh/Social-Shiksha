<?php

namespace App\Http\Controllers;

use App\CoachingDetails;
use App\NoticeBoardDetails;
use App\TeacherStudentDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class InstitutionController extends Controller
{
    private $user;

    public function dashboard()
    {
        return view('Institutions.institution_dashboard');
    }

    public function view_profile()
    {
        $this->user = Auth::user();
        $institute = CoachingDetails::where('Inst_Email',$this->user->email)->first();

        return view('institutions.profile.view_profile')->with(['institute'=>$institute]);
    }

    public function edit_profile()
    {
        $this->user = Auth::user();
        $institute = CoachingDetails::where('Inst_Email',$this->user->email)->first();

        return view('institutions.profile.edit_profile')->with(['institute'=>$institute]);
    }

    public function update_profile(Request $request)
    {
        //dd($request);
        $this->user = Auth::user();
        $institute = CoachingDetails::where('Inst_Email',$this->user->email)->first();

        $fileName= $institute->Inst_File_Name;

        if($request->hasFile('profile-avatar'))
        {
            $oldFileName = $fileName;
            $avatar = $request->file('profile-avatar');
            $fileName = $institute->id.time().'.'.$avatar->getClientOriginalExtension();

            // check or create directory for photo upload
            $path = storage_path('app\public\uploads\avatars\institutions');

            if(!File::exists($path))
                File::makeDirectory($path,777,true);

            if(Image::make($avatar)->resize(200,200)->save($path.'\\'.$fileName))
                File::delete($path.'\\'.$oldFileName);
        }

        $institute->fill($request->all());
        $institute->Ent_Type = 'E';
        $institute->Inst_File_Name = $fileName;

        if($institute->save())
            return redirect('/institution/view-profile')->with('message','Profile Updated Successfully!');
        else
            return back()->with('message','Unable to update profile. Try again!');
    }

    public function show_teacher_details()
    {
        $teachers = TeacherStudentDetail::where([['Ent_Type','<>','D'],['Role_Type','=','T']])->get();
        return view('Institutions.institution_show_teacher_details')->with(['teachers'=>$teachers]);
    }

    public function show_student_details()
    {
        $students = TeacherStudentDetail::where([['Ent_Type','<>','D'],['Role_Type','=','S']])->get();
        return view('Institutions.institution_show_student_details')->with(['students'=>$students]);
    }

    public function delete_teacher_student_record($id)
    {
        try
        {
            $user = TeacherStudentDetail::findOrFail($id);
            $user->Ent_Type = 'D';
            if($user->save())
                return back()->with('message', 'Record Deleted Successfully!');
            else
                return back()->with('message', 'Could Not Delete Record! Try Again.');

        } catch( ModelNotFoundException $e) {
            return back()->with('message', 'No Such User Exists!');
        }
    }

    public function showNoticeBoard()
    {
        $notices = NoticeBoardDetails::where('Ent_Type','<>','D')->orderBy('NB_Date','DESC')->get();

        $authors = [];
        foreach ($notices as $notice)
        {
            $authors[$notice->id]= DB::table('teacher_student_details')->where('id',$notice->NB_T_Id)->value('T_Stu_Name');
        }

        return view('Institutions.institution_notice_board')->with(['authors'=>$authors,'notices'=>$notices]);;
    }
}
