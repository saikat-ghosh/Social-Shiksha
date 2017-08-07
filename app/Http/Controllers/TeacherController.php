<?php

namespace App\Http\Controllers;

use App\AssignmentsTeacherUpload;
use App\AttendanceDetails;
use App\BatchDetail;
use App\MockTestDetails;
use App\PerformanceDetails;
use App\StudyMaterialDetails;
use App\TeacherStudentDetail;
use App\TSBatchRelation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class TeacherController extends Controller
{
    private $user;

    /*
    |------------------------------------------------------------------------------
    | Method for retrieving Teacher model from User model
    |------------------------------------------------------------------------------
    */
    public function getCurrentTeacher()
    {
        $this->user = Auth::user();
        $teacher = TeacherStudentDetail::where('T_Stu_Email',$this->user->email)->first();
        return $teacher;
    }

    /*
    |------------------------------------------------------------------------------
    | Method for displaying teacher dashboard
    |------------------------------------------------------------------------------
    */
    public function dashboard()
    {
        return view('Teachers.teacher_dashboard');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods to view/update teacher's profile
    |------------------------------------------------------------------------------
    */
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
        $validator = Validator::make($request->all(), [
            'T_Stu_Name' => 'required|max:255',
            'T_Stu_No' => 'required|digits:10',
        ],[
            'T_Stu_Name.required' => 'This field is mandatory.',
            'T_Stu_No.required' => 'This field is mandatory.',
            'T_Stu_No.digits' => 'Phone Number must contain 10 digits.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
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

    /*
    |------------------------------------------------------------------------------
    | Methods for teacher to view/remove associated batches or join new batch
    |------------------------------------------------------------------------------
    */

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

    /*
    |------------------------------------------------------------------------------
    | Method to find all student associated to a particular batch
    |------------------------------------------------------------------------------
    */
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

    /*
    |------------------------------------------------------------------------------
    | Methods for Student Marks Upload
    |------------------------------------------------------------------------------
    */
    public function selectBatchForMarksUpload()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }
        //dd($batches);

        return view('teachers.upload-students-marks.usm_select_batch')->with(['batches'=>$batches]);
    }

    public function selectStudentForMarksUpload()
    {
        if (Input::has('Batch_Id'))
        {
            $batch_id = Input::get('Batch_Id');

            $students = $this->getStudentsByBatch($batch_id);

            return view('teachers.upload-students-marks.usm_select_student')->with(['students'=>$students, 'batch_id'=> $batch_id]);

        } else {
            return view('');
        }
    }

    public function uploadMarks($batch_id, $student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);

        $batch = BatchDetail::findOrFail($batch_id);

        return view('teachers.upload-students-marks.usm_upload_marks')->with(['student'=>$student, 'batch'=>$batch]);
    }

    public function saveUploadedMarks(Request $request)
    {
        $uploadedMarks = new PerformanceDetails($request->all());
        $uploadedMarks->Role_Type = 'S';

        if($uploadedMarks->save())
            return redirect('teacher/upload-student-marks')->with('message','Marks uploaded successfully!');
        else
            return back()->with('message','Could not upload marks. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Student Attendance Upload
    |------------------------------------------------------------------------------
    */
    public function selectBatchForAttendanceUpload()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        return view('teachers.upload-Attendance.ua_select_batch')->with(['batches'=>$batches]);
    }

    public function selectStudentForAttendanceUpload()
    {
        if (Input::has('Batch_Id'))
        {
            $batch_id = Input::get('Batch_Id');

            $students = $this->findStudentsWithNoAttendance($batch_id);

            return view('teachers.upload-attendance.ua_select_student')->with(['students'=>$students, 'batch_id'=> $batch_id]);

        }
    }

    public function findStudentsWithNoAttendance($id)
    {
        try {
            $student_ids = DB::table('t_s_batch_relations')->where([['Role_Type','S'],['TSB_Batch_Id', $id],['Ent_Type','<>','D']])->pluck('TSB_T_Stu_Id');

            $students = [];

            foreach ($student_ids as $index => $id)
            {
                $hasAttendance = DB::table('attendance_details')->where([['Att_Date','=', date('Y-m-d')],['Att_User_Id','=',$id]])->first();
                if(!$hasAttendance)
                    $students[$id] = TeacherStudentDetail::findOrFail($id);
            }

        }catch( ModelNotFoundException $e) {
            return back()->with('message', 'No Such Student/Batch Exists!');
        }
        return $students;
    }

    public function uploadAttendance($batch_id, $student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);

        $batch = BatchDetail::findOrFail($batch_id);

        $date = Date('d-m-Y');

        return view('teachers.upload-attendance.ua_upload_attendance')->with(['student'=>$student, 'batch'=>$batch, 'date'=>$date]);
    }

    public function saveUploadedAttendance(Request $request)
    {
        $uploadedAttendance = new AttendanceDetails($request->all());

        $uploadedAttendance->Att_Date = Date('Y-m-d');

        if($uploadedAttendance->save())
            return redirect('teacher/upload-attendance')->with('message','Attendance uploaded successfully!');
        else
            return back()->with('message','Could not upload attendance. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Study Material Upload
    |------------------------------------------------------------------------------
    */
    public function uploadStudyMaterial()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        $uploadedFiles = DB::table('study_material_details')->where([['SM_User_Id', $teacher->id],['Ent_Type','<>','D']])->orderBy('SM_Upload_Date','DESC')->get();

        return view('teachers.upload_study_material')->with(['batches'=>$batches, 'teacher'=> $teacher, 'uploadedFiles'=>$uploadedFiles]);
    }

    public function saveUploadedStudyMaterial(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->SM_Batch_Id);

        if($request->hasFile('File_Name') && $request->has('SM_Batch_Id'))
        {
            $uploadedFile = $request->file('File_Name');

            $fileName = $request->File_Name->getClientOriginalName();

            $path = Storage::putFileAs('uploads\study-materials', $uploadedFile, $fileName);

            $studyMaterial = new StudyMaterialDetails($request->all());

            $studyMaterial->SM_File_Name = $fileName;

            $studyMaterial->SM_Subject = $batch->Batch_Subject;

            $studyMaterial->SM_Upload_Date = Date('Y-m-d');

            $studyMaterial->Role_Type = 'T';

            if ($studyMaterial->save())
                return redirect('teacher/upload-study-material')->with('message', 'Study material uploaded successfully!');
            else
                return back()->with('message', 'Could not save study material. Try again!');
        }
        else
            return back()->with('message', 'Could not upload study material. Try again!');
    }

    public function deleteUploadedStudyMaterial($id)
    {
        $studyMaterial = StudyMaterialDetails::findOrFail($id);

        $studyMaterial->Ent_Type = 'D';

        if($studyMaterial->save())
        {
            $path = storage_path('app\public\uploads\study-materials');

            if(File::exists($path.'\\'.$studyMaterial->SM_File_Name))
                File::delete($path.'\\'.$studyMaterial->SM_File_Name);

            return back()->with('message', 'Study material deleted!');
        }
        else
            return back()->with('message', 'Could not delete study material. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Mock Test/ Practice Paper Upload
    |------------------------------------------------------------------------------
    */
    public function uploadMockTestOrPracticePaper()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        $uploadedFiles = DB::table('mock_test_details')->where([['MT_User_Id', $teacher->id],['Ent_Type','<>','D']])->orderBy('MT_Upload_Date','DESC')->get();

        return view('teachers.upload_mock_test_or_practice_paper')->with(['batches'=>$batches, 'teacher'=> $teacher,'uploadedFiles'=>$uploadedFiles]);
    }

    public function saveUploadedMockTestOrPracticePaper(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->MT_Batch_Id);

        if($request->hasFile('File_Name') && $request->has('MT_Batch_Id'))
        {
            $uploadedFile = $request->file('File_Name');

            $fileName = $request->File_Name->getClientOriginalName();

            $path = Storage::putFileAs('uploads\mock-test-OR-practice-papers', $uploadedFile, $fileName);

            $mockTestOrPracticePaper = new MockTestDetails($request->all());

            $mockTestOrPracticePaper->MT_File_Name = $fileName;

            $mockTestOrPracticePaper->MT_Subject = $batch->Batch_Subject;

            $mockTestOrPracticePaper->MT_Upload_Date = Date('Y-m-d');

            $mockTestOrPracticePaper->Role_Type = 'T';

            if ($mockTestOrPracticePaper->save())
                return redirect('teacher/upload-test-or-practice-paper')->with('message', 'Test/Practice paper uploaded successfully!');
            else
                return back()->with('message', 'Could not save test/practice paper. Try again!');
        }
        else
            return back()->with('message', 'Could not upload test/practice paper. Try again!');
    }

    public function deleteUploadedMockTestOrPracticePaper($id)
    {
        $mockTestOrPracticePaper = MockTestDetails::findOrFail($id);

        $mockTestOrPracticePaper->Ent_Type = 'D';

        if($mockTestOrPracticePaper->save())
        {
            $path = storage_path('app\public\uploads\mock-test-OR-practice-papers');

            if(File::exists($path.'\\'.$mockTestOrPracticePaper->MT_File_Name))
                File::delete($path.'\\'.$mockTestOrPracticePaper->MT_File_Name);

            return back()->with('message', 'Test / practice paper deleted!');
        }
        else
            return back()->with('message', 'Could not delete test/practice paper. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Assignment Upload
    |------------------------------------------------------------------------------
    */
    public function uploadAssignment()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        $uploadedFiles = DB::table('assignments_teacher_uploads')->where([['ATU_User_Id', $teacher->id],['Ent_Type','<>','D']])->orderBy('ATU_Upload_Date','DESC')->get();

        return view('teachers.upload_assignment')->with(['batches'=>$batches, 'teacher'=> $teacher, 'uploadedFiles'=>$uploadedFiles]);
    }

    public function saveUploadedAssignment(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->ATU_Batch_Id);

        if($request->hasFile('File_Name') && $request->has('ATU_Batch_Id'))
        {
            $uploadedFile = $request->file('File_Name');

            $fileName = $request->File_Name->getClientOriginalName();

            $path = Storage::putFileAs('uploads\assignments', $uploadedFile, $fileName);

            $assignment = new AssignmentsTeacherUpload($request->all());

            $assignment->ATU_File_Name = $fileName;

            $assignment->ATU_Subject = $batch->Batch_Subject;

            $assignment->ATU_Upload_Date = Date('Y-m-d');

            $assignment->Role_Type = 'T';

            if ($assignment->save())
                return redirect('teacher/upload-assignment')->with('message', 'Assignment uploaded successfully!');
            else
                return back()->with('message', 'Could not save assignment. Try again!');
        }
        else
            return back()->with('message', 'Could not upload assignment. Try again!');
    }

    public function deleteUploadedAssignment($id)
    {
        $assignment = AssignmentsTeacherUpload::findOrFail($id);

        $assignment->Ent_Type = 'D';

        if($assignment->save())
        {
            $path = storage_path('app\public\uploads\assignments');

            if(File::exists($path.'\\'.$assignment->ATU_File_Name))
               File::delete($path.'\\'.$assignment->ATU_File_Name);

            return back()->with('message', 'Assignment deleted!');
        }
        else
            return back()->with('message', 'Could not delete assignment. Try again!');
    }
}
