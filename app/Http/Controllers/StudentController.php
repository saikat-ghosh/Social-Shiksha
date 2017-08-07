<?php

namespace App\Http\Controllers;

use App\TeacherStudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    private $user;

    public function getCurrentStudent()
    {
        $this->user = Auth::user();
        $student = TeacherStudentDetail::where('T_Stu_Email',$this->user->email)->first();
        return $student;
    }

    public function dashboard()
    {
        return view('students.student_dashboard');
    }

    public function view_profile()
    {
        $student = $this->getCurrentStudent();
        return view('students.profile.view_profile')->with(['student'=>$student]);
    }

    public function edit_profile()
    {
        $student = $this->getCurrentStudent();
        return view('students.profile.edit_profile')->with(['student'=>$student]);
    }

    public function update_profile(Request $request)
    {
        $student = $this->getCurrentStudent();
        $fileName= $student->T_Stu_File_Name;

        if($request->hasFile('profile-avatar'))
        {
            $oldFileName = $fileName;
            $avatar = $request->file('profile-avatar');
            $fileName = $student->id.time().'.'.$avatar->getClientOriginalExtension();

            // check or create directory for photo upload
            $path = storage_path('app\public\uploads\avatars\students');

            if(!File::exists($path))
                File::makeDirectory($path,777,true);

            if(Image::make($avatar)->resize(200,200)->save($path.'\\'.$fileName))
                File::delete(storage_path('app\public\uploads\avatars\students\\'.$oldFileName));
        }

        $student->fill($request->all());
        $student->Ent_Type = 'E';
        $student->T_Stu_File_Name = $fileName;

        if($student->save())
            return redirect('/student/view-profile')->with('message','Profile Updated Successfully!');
        else
            return back()->with('message','Unable to update profile. Try again!');
    }

    public function show_batches()
    {
        $teacher = $this->getCurrentTeacher();

        $allBatches = BatchDetail::all();

        $teacherBatches = [];

        $teacherBatchesId = TSBatchRelation::where([['TSB_T_Stu_Id',$teacher->id],['Ent_type','<>','D']])->select('id','TSB_Batch_Id')->get();

        foreach($teacherBatchesId as $id=>$item)
        {
            $batch = BatchDetail::where('id',$item->TSB_Batch_Id)->select('id','Batch_Code','Batch_Subject')->first();
            $teacherBatches[$item->id] = $batch;
        }
        //dd($teacherBatches);
        return view('teachers.batch_details')->with(['allBatches'=>$allBatches,'teacherBatches'=>$teacherBatches]);
    }

    public function assign_batch(Request $request)
    {
        $teacher = $this->getCurrentTeacher();

        $assignedBatch = TSBatchRelation::create([
            'TSB_T_Stu_Id'=>$teacher->id,
            'TSB_Batch_Id'=>$request->batch_id,
            'Role_Type'=>'T'
        ]);
        return response()->json(['assignedBatch'=>$assignedBatch]);
    }

    public function remove_batch($id)
    {
        try
        {
            $removedBatch = TSBatchRelation::findOrFail($id);
            $removedBatch->Ent_Type = 'D';
            if($removedBatch->save())
                return redirect('teacher/batches')->with(['message'=>'Record deleted successfully!']);
            else
                return redirect('teacher/batches')->with(['message'=> 'Could Not Delete Record! Try Again.']);

        } catch( ModelNotFoundException $e) {
            return redirect('teacher/batches')->with(['message'=> 'No Such Batch Exists!']);
        }

    }

}
