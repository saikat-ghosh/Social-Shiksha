<?php

namespace App\Http\Controllers;

use App\AssignmentsStudentUpload;
use App\AssignmentsTeacherUpload;
use App\BatchDetail;
use App\ExamQuestionDetails;
use App\ExamResponseDetails;
use App\ExamUploadDetails;
use App\MockTestDetails;
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

    /*
    |------------------------------------------------------------------------------
    | Method to retrieve all batches the student currently associated with
    |------------------------------------------------------------------------------
    */
    public function getAssociatedBatches()
    {
        $student = $this->getCurrentStudent();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $student->id],['Ent_Type','<>','D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach($batch_ids as $index=>$id)
        {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        return $batches;
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

    /*
    |------------------------------------------------------------------------------
    | Methods for student to view/remove associated batches or join new batch
    |------------------------------------------------------------------------------
    */

    public function showBatches()
    {
        $student = $this->getCurrentStudent();
        $associated_batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $student->id], ['Ent_Type', '<>', 'D']])->pluck('TSB_Batch_Id');

        $associatedBatches = $this->getAssociatedBatches();
        $remainingBatches = BatchDetail::whereNotIn('id', $associated_batch_ids)->where('Ent_Type', '<>', 'D')->get();

        return view('students.student_batch_details')->with(['remainingBatches' => $remainingBatches, 'associatedBatches' => $associatedBatches]);
    }

    public function assignBatch(Request $request)
    {
        $student = $this->getCurrentStudent();

        $assignedBatch = TSBatchRelation::firstOrCreate([
            'TSB_T_Stu_Id' => $student->id,
            'TSB_Batch_Id' => $request->Batch_Id,
            'Role_Type' => 'S'
        ]);

        $assignedBatch->Ent_Type = 'I';

        if($assignedBatch->save())
            return redirect('student/batch-details')->with(['message' => 'Joined batch successfully!']);
        else
            return redirect('student/batch-details')->with(['message' => 'Could not join batch! Try again.']);

    }

    public function removeBatch($batch_id)
    {
        $student = $this->getCurrentStudent();
        try {
            $removedBatch = TSBatchRelation::where([['TSB_T_Stu_Id',$student->id],['TSB_Batch_Id',$batch_id]])->first();
            $removedBatch->Ent_Type = 'D';

            if ($removedBatch->save())
                return redirect('student/batch-details')->with(['message' => 'Batch removed successfully!']);
            else
                return redirect('student/batch-details')->with(['message' => 'Could not remove batch! Try again.']);

        } catch (ModelNotFoundException $e) {
            return redirect('student/batch-details')->with(['message' => 'No Such Batch Exists!']);
        }

    }

    /*
    |------------------------------------------------------------------------------
    | Methods for giving Exams
    |------------------------------------------------------------------------------
    */
    public function selectBatchForGivingExam()
    {
        $batches = $this->getAssociatedBatches();
        return view('students.give-exams.ge_select_batch')->with('batches',$batches);
    }

    public function selectExam(Request $request)
    {
        if(Input::has('Batch_Id'))
        {
            $student = $this->getCurrentStudent();

            $exam_ids = ExamUploadDetails::where([['EU_Batch_Id','=',$request->Batch_Id],['Ent_Type','<>','D']])->pluck('id');

            $exams = [];

            foreach($exam_ids as $id)
            {
                $examAlreadyGiven = DB::table('exam_response_details')->where([['ER_User_Id','=', $student->id],['ER_EU_Id','=',$id]])->first();

                if(!$examAlreadyGiven)
                    $exams[$id] = ExamUploadDetails::findOrFail($id);
            }

            return view('students.give-exams.ge_select_exam')->with(['exams'=>$exams]);
        }
    }

    public function confirmExam($exam_id)
    {
        $exam = ExamUploadDetails::findOrFail($exam_id);
        return view('students.give-exams.ge_start_exam')->with(['exam'=>$exam]);
    }

    public function startExam($exam_id,$question_no)
    {
        $question = ExamQuestionDetails::where([['EQ_EU_Id','=',$exam_id],['EQ_Q_Number','=',$question_no],['Ent_Type','<>','D']])->first();

        return view('students.give-exams.ge_answer_questions')->with(['exam_id'=> $exam_id,'question'=>$question,'question_no'=>$question_no]);
    }

    public function saveStudentResponse($exam_id,$question_no,Request $request)
    {
        $student = $this->getCurrentStudent();

        $response = ExamResponseDetails::firstOrCreate([
                        'ER_EU_Id' => $request->ER_EU_Id,
                        'ER_EQ_Id' => $request->ER_EQ_Id,
                        'ER_User_Id' => $student->id,
                        'ER_Q_Type' => $request->ER_Q_Type,
                        'ER_Q' => $request->ER_Q,
                        'ER_Ans' => $request->ER_Ans,
                        'ER_Max_Marks' => $request->ER_Max_Marks
                    ]);

        if($question_no <= $request->total_questions)
        {
            $question = ExamQuestionDetails::where([['EQ_EU_Id','=',$exam_id],['EQ_Q_Number','=',$question_no],['Ent_Type','<>','D']])->first();
            return view('students.give-exams.ge_answer_questions')->with(['exam_id'=> $exam_id,'question'=>$question,'question_no'=>$question_no]);
        }else
            return redirect('student/give-exam')->with('message','Exam completed successfully!');

    }

    /*
    |------------------------------------------------------------------------------
    | Methods for downloading study materials
    |------------------------------------------------------------------------------
    */
    public function selectBatchForDownloadingStudyMaterials()
    {
        $batches = $this->getAssociatedBatches();
        return view('students.download-study-materials.dsm_select_batch')->with('batches',$batches);
    }

    public function downloadStudyMaterials(Request $request)
    {
        $studyMaterials = StudyMaterialDetails::where([['SM_Batch_Id','=',$request->Batch_Id],['Ent_Type','<>','D']])->get();
        return view('students.download-study-materials.dsm_download_study_materials')->with('studyMaterials',$studyMaterials);
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for downloading mock test/practice papers
    |------------------------------------------------------------------------------
    */
    public function selectBatchForDownloadingMockTestOrPracticePapers()
    {
        $batches = $this->getAssociatedBatches();
        return view('students.download-mock-test-or-practice-papers.dtp_select_batch')->with('batches',$batches);
    }

    public function downloadMockTestOrPracticePapers(Request $request)
    {
        $mockTestOrPracticePapers = MockTestDetails::where([['MT_Batch_Id','=',$request->Batch_Id],['Ent_Type','<>','D']])->get();
        return view('students.download-mock-test-or-practice-papers.dtp_download_mock_test_or_practice_papers')->with('mockTestOrPracticePapers',$mockTestOrPracticePapers);
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for downloading assignments
    |------------------------------------------------------------------------------
    */
    public function selectBatchForDownloadingAssignments()
    {
        $batches = $this->getAssociatedBatches();
        return view('students.download-assignments.da_select_batch')->with('batches',$batches);
    }

    public function downloadAssignments(Request $request)
    {
        $assignments = AssignmentsTeacherUpload::where([['ATU_Batch_Id','=',$request->Batch_Id],['Ent_Type','<>','D']])->get();
        return view('students.download-assignments.da_download_assignments')->with('assignments',$assignments);
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for uploading assignment
    |------------------------------------------------------------------------------
    */
    public function uploadAssignment()
    {
        $student = $this->getCurrentStudent();

        $batches = $this->getAssociatedBatches();

        $uploadedFiles = DB::table('assignments_student_uploads')->where([['ASU_User_Id', $student->id],['Ent_Type','<>','D']])->orderBy('ASU_Upload_Date','DESC')->get();

        return view('students.upload_assignment')->with(['batches'=>$batches, 'student'=> $student, 'uploadedFiles'=>$uploadedFiles]);
    }

    public function saveUploadedAssignment(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->ASU_Batch_Id);

        if($request->hasFile('File_Name') && $request->has('ASU_Batch_Id'))
        {
            $uploadedFile = $request->file('File_Name');

            $fileName = $request->File_Name->getClientOriginalName();

            $path = Storage::putFileAs('uploads\assignments\student-uploads', $uploadedFile, $fileName);

            $assignment = new AssignmentsStudentUpload($request->all());

            $assignment->ASU_File_Name = $fileName;

            $assignment->ASU_Subject = $batch->Batch_Subject;

            $assignment->ASU_Upload_Date = Date('Y-m-d');

            $assignment->Role_Type = 'S';

            if ($assignment->save())
                return redirect('student/upload-assignment')->with('message', 'Assignment uploaded successfully!');
            else
                return back()->with('message', 'Could not save assignment. Try again!');
        }
        else
            return back()->with('message', 'Could not upload assignment. Try again!');
    }

    public function deleteUploadedAssignment($id)
    {
        $assignment = AssignmentsStudentUpload::findOrFail($id);

        $assignment->Ent_Type = 'D';

        if($assignment->save())
        {
            $path = storage_path('app\public\uploads\assignments\student-uploads');

            if(File::exists($path.'\\'.$assignment->ASU_File_Name))
                File::delete($path.'\\'.$assignment->ASU_File_Name);

            return back()->with('message', 'Assignment deleted!');
        }
        else
            return back()->with('message', 'Could not delete assignment. Try again!');
    }
}
