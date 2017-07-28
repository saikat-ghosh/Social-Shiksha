<?php

namespace App\Http\Controllers;

use App\CoachingDetails;
use App\TeacherStudentDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $fileName = time().'.'.$avatar->getClientOriginalExtension();
            if(Image::make($avatar)->resize(200,200)->save(public_path('uploads\avatars\institution\\'.$fileName)))
                File::delete(public_path('uploads\avatars\institution\\'.$oldFileName));
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
}
