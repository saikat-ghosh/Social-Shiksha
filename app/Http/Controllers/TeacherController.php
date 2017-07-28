<?php

namespace App\Http\Controllers;

use App\BatchDetail;
use App\TeacherStudentDetail;
use App\TSBatchRelation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    private $user;

    public function dashboard()
    {
        return view('Teachers.teacher_dashboard');
    }

    public function view_profile()
    {
        $teacher = $this->getCurrentTeacher();
        return view('teachers.profile.view_profile')->with(['teacher'=>$teacher]);
    }

    public function edit_profile()
    {
        $teacher = $this->getCurrentTeacher();
        return view('teachers.profile.edit_profile')->with(['teacher'=>$teacher]);
    }

    public function update_profile(Request $request)
    {
        $teacher = $this->getCurrentTeacher();
        $fileName= $teacher->T_Stu_File_Name;

        if($request->hasFile('profile-avatar'))
        {
            $oldFileName = $fileName;
            $avatar = $request->file('profile-avatar');
            $fileName = time().'.'.$avatar->getClientOriginalExtension();
            if(Image::make($avatar)->resize(200,200)->save(public_path('uploads\avatars\teachers\\'.$fileName)))
            File::delete(public_path('uploads\avatars\teachers\\'.$oldFileName));
        }

        $teacher->fill($request->all());
        $teacher->Ent_Type = 'E';
        $teacher->T_Stu_File_Name = $fileName;

        if($teacher->save())
            return redirect('/teacher/view-profile')->with('message','Profile Updated Successfully!');
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

    public function getCurrentTeacher()
    {
        $this->user = Auth::user();
        $teacher = TeacherStudentDetail::where('T_Stu_Email',$this->user->email)->first();
        return $teacher;
    }

}
