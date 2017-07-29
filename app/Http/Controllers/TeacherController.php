<?php

namespace App\Http\Controllers;

use App\BatchDetail;
use App\PerformanceDetails;
use App\TeacherStudentDetail;
use App\TSBatchRelation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    private $user;

    public function getCurrentTeacher()
    {
        $this->user = Auth::user();
        $teacher = TeacherStudentDetail::where('T_Stu_Email',$this->user->email)->first();
        return $teacher;
    }

    public function dashboard()
    {
        return view('teachers.teacher_dashboard');
    }

    public function viewProfile()
    {
        $teacher = $this->getCurrentTeacher();
        return view('teachers.profile.view_profile')->with(['teacher'=>$teacher]);
    }

    public function editProfile()
    {
        $teacher = $this->getCurrentTeacher();
        return view('teachers.profile.edit_profile')->with(['teacher'=>$teacher]);
    }

    public function updateProfile(Request $request)
    {
        $teacher = $this->getCurrentTeacher();
        $fileName= $teacher->T_Stu_File_Name;

        if($request->hasFile('profile-avatar'))
        {
            $oldFileName = $fileName;
            $avatar = $request->file('profile-avatar');
            $fileName = $teacher->id.time().'.'.$avatar->getClientOriginalExtension();

            // check or create directory for photo upload
            $path = storage_path('app\public\uploads\avatars\teachers');

            if(!File::exists($path))
                File::makeDirectory($path,777,true);

            if(Image::make($avatar)->resize(200,200)->save($path.'\\'.$fileName))
                File::delete($path.'\\'.$oldFileName);
        }

        $teacher->fill($request->all());
        $teacher->Ent_Type = 'E';
        $teacher->T_Stu_File_Name = $fileName;

        if($teacher->save())
            return redirect('/teacher/view-profile')->with('message','Profile Updated Successfully!');
        else
            return back()->with('message','Unable to update profile. Try again!');
    }

    public function showBatches()
    {
        $teacher = $this->getCurrentTeacher();

        $allBatches = BatchDetail::all();

        $teacherBatches = [];

        $teacherBatchesId = TSBatchRelation::where([['TSB_T_Stu_Id',$teacher->id],['Ent_type','<>','D']])->select('id','TSB_Batch_Id')->get();

        foreach($teacherBatchesId as $id=>$item)
        {
            $teacherBatches[$item->id] = BatchDetail::where('id',$item->TSB_Batch_Id)->select('id','Batch_Code','Batch_Subject')->first();
        }

        return view('teachers.batch_details')->with(['allBatches'=>$allBatches,'teacherBatches'=>$teacherBatches]);
    }

    public function assignBatch(Request $request)
    {
        $teacher = $this->getCurrentTeacher();

        $assignedBatch = TSBatchRelation::create([
                            'TSB_T_Stu_Id'=>$teacher->id,
                            'TSB_Batch_Id'=>$request->batch_id,
                            'Role_Type'=>'T'
                        ]);
        return response()->json(['assignedBatch'=>$assignedBatch]);
    }

    public function removeBatch($id)
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

    public function searchStudentFormForMarksUpload()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }
        //dd($batches);

        return view('teachers.upload-students-marks.search_student_form')->with(['batches'=>$batches]);
    }

    public function getStudentForMarksUpload()
    {
        if (Input::has('Batch_Id'))
        {
            $batch_id = Input::get('Batch_Id');

            $students = $this->getStudentsByBatch($batch_id);

            return view('teachers.upload-students-marks.select_student')->with(['students'=>$students, 'batch_id'=> $batch_id]);

        } else {
            return view('admin.buses.search-bus');
        }
    }

    public function getStudentsByBatch($id)
    {
        try {
            $student_ids = DB::table('t_s_batch_relations')->where([['Role_Type','S'],['TSB_Batch_Id', $id],['Ent_Type','<>','D']])->pluck('TSB_T_Stu_Id');

            $students = [];

            foreach ($student_ids as $index => $id)
            {
                $students[$id] = TeacherStudentDetail::findOrFail($id);
            }
        }catch( ModelNotFoundException $e) {
            return back()->with('message', 'No Such Student/Batch Exists!');
        }
        return $students;
    }

    public function showUploadMarksForm($batch_id, $student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);

        $batch = BatchDetail::findOrFail($batch_id);

        return view('teachers.upload-students-marks.upload_marks')->with(['student'=>$student, 'batch'=>$batch]);
    }

    public function saveUploadedMarks(Request $request)
    {
        $uploadedMarks = new PerformanceDetails($request->all());
        $uploadedMarks->Role_Type = 'T';

        if($uploadedMarks->save())
            return redirect('teacher/upload-student-marks')->with('message','Marks uploaded successfully!');
        else
            return back()->with('message','Could not upload marks. Try again!');
    }
}
