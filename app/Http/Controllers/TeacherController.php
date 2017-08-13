<?php

namespace App\Http\Controllers;

use App\AssignmentsStudentUpload;
use App\AssignmentsTeacherUpload;
use App\AttendanceDetails;
use App\BatchDetail;
use App\ExamQuestionDetails;
use App\ExamResponseDetails;
use App\ExamUploadDetails;
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
        $teacher = TeacherStudentDetail::where('T_Stu_Email', $this->user->email)->first();
        return $teacher;
    }

    /*
    |------------------------------------------------------------------------------
    | Method to retrieve all batches the teacher currently associated with
    |------------------------------------------------------------------------------
    */
    public function getAssociatedBatches()
    {
        $teacher = $this->getCurrentTeacher();

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach ($batch_ids as $index => $id) {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        return $batches;
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
        return view('teachers.profile.view_profile')->with(['teacher' => $teacher]);
    }

    public function editProfile()
    {
        $teacher = $this->getCurrentTeacher();
        return view('teachers.profile.edit_profile')->with(['teacher' => $teacher]);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'T_Stu_Name' => 'required|max:255',
            'T_Stu_No' => 'required|digits:10',
        ], [
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
        $fileName = $teacher->T_Stu_File_Name;

        if ($request->hasFile('profile-avatar')) {
            $oldFileName = $fileName;
            $avatar = $request->file('profile-avatar');
            $fileName = $teacher->id . time() . '.' . $avatar->getClientOriginalExtension();

            // check or create directory for photo upload
            $path = storage_path('app\public\uploads\avatars\teachers');

            if (!File::exists($path))
                File::makeDirectory($path, 777, true);

            if (Image::make($avatar)->resize(200, 200)->save($path . '\\' . $fileName))
                File::delete($path . '\\' . $oldFileName);
        }

        $teacher->fill($request->all());
        $teacher->Ent_Type = 'E';
        $teacher->T_Stu_File_Name = $fileName;

        if ($teacher->save())
            return redirect('/teacher/view-profile')->with('message', 'Profile Updated Successfully!');
        else
            return back()->with('message', 'Unable to update profile. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for teacher to view/remove associated batches or join new batch
    |------------------------------------------------------------------------------
    */

    public function showBatches()
    {
        $teacher = $this->getCurrentTeacher();
        $associated_batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->pluck('TSB_Batch_Id');

        $associatedBatches = $this->getAssociatedBatches();
        $remainingBatches = BatchDetail::whereNotIn('id', $associated_batch_ids)->where('Ent_Type', '<>', 'D')->get();

        return view('teachers.teacher_batch_details')->with(['remainingBatches' => $remainingBatches, 'associatedBatches' => $associatedBatches]);
    }

    public function assignBatch(Request $request)
    {
        $teacher = $this->getCurrentTeacher();

        $assignedBatch = TSBatchRelation::firstOrCreate([
            'TSB_T_Stu_Id' => $teacher->id,
            'TSB_Batch_Id' => $request->Batch_Id,
            'Role_Type' => 'T'
        ]);

        $assignedBatch->Ent_Type = 'I';

        if($assignedBatch->save())
            return redirect('teacher/batches')->with(['message' => 'Joined batch successfully!']);
        else
            return redirect('teacher/batches')->with(['message' => 'Could not join batch! Try again.']);

    }

    public function removeBatch($batch_id)
    {
        $teacher = $this->getCurrentTeacher();
        try {
            $removedBatch = TSBatchRelation::where([['TSB_T_Stu_Id',$teacher->id],['TSB_Batch_Id',$batch_id]])->first();;
            $removedBatch->Ent_Type = 'D';

            if ($removedBatch->save())
                return redirect('teacher/batches')->with(['message' => 'Batch removed successfully!']);
            else
                return redirect('teacher/batches')->with(['message' => 'Could not remove batch! Try again.']);

        } catch (ModelNotFoundException $e) {
            return redirect('teacher/batches')->with(['message' => 'No Such Batch Exists!']);
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
            $student_ids = DB::table('t_s_batch_relations')->where([['Role_Type', 'S'], ['TSB_Batch_Id', $id], ['Ent_Type', '<>', 'D']])->pluck('TSB_T_Stu_Id');

            $students = [];

            foreach ($student_ids as $index => $id) {
                $students[$id] = TeacherStudentDetail::findOrFail($id);
            }
        } catch (ModelNotFoundException $e) {
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

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach ($batch_ids as $index => $id) {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        return view('teachers.upload-students-marks.usm_select_batch')->with(['batches' => $batches]);
    }

    public function selectStudentForMarksUpload()
    {
        if (Input::has('Batch_Id')) {
            $batch_id = Input::get('Batch_Id');

            $students = $this->getStudentsByBatch($batch_id);

            return view('teachers.upload-students-marks.usm_select_student')->with(['students' => $students, 'batch_id' => $batch_id]);

        } else {
            return view('');
        }
    }

    public function uploadMarks($batch_id, $student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);

        $batch = BatchDetail::findOrFail($batch_id);

        return view('teachers.upload-students-marks.usm_upload_marks')->with(['student' => $student, 'batch' => $batch]);
    }

    public function saveUploadedMarks(Request $request)
    {
        $uploadedMarks = new PerformanceDetails($request->all());
        $uploadedMarks->Role_Type = 'S';

        if ($uploadedMarks->save())
            return redirect('teacher/upload-student-marks')->with('message', 'Marks uploaded successfully!');
        else
            return back()->with('message', 'Could not upload marks. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Student Attendance Upload
    |------------------------------------------------------------------------------
    */
    public function selectBatchForAttendanceUpload()
    {
        $batches = $this->getAssociatedBatches();

        return view('teachers.upload-Attendance.ua_select_batch')->with(['batches' => $batches]);
    }

    public function selectStudentForAttendanceUpload()
    {
        if (Input::has('Batch_Id')) {
            $batch_id = Input::get('Batch_Id');

            $students = $this->findStudentsWithNoAttendance($batch_id);

            return view('teachers.upload-attendance.ua_select_student')->with(['students' => $students, 'batch_id' => $batch_id]);

        }
    }

    public function findStudentsWithNoAttendance($id)
    {
        try {
            $student_ids = DB::table('t_s_batch_relations')->where([['Role_Type', 'S'], ['TSB_Batch_Id', $id], ['Ent_Type', '<>', 'D']])->pluck('TSB_T_Stu_Id');

            $students = [];

            foreach ($student_ids as $index => $id) {
                $hasAttendance = DB::table('attendance_details')->where([['Att_Date', '=', date('Y-m-d')], ['Att_User_Id', '=', $id]])->first();
                if (!$hasAttendance)
                    $students[$id] = TeacherStudentDetail::findOrFail($id);
            }

        } catch (ModelNotFoundException $e) {
            return back()->with('message', 'No Such Student/Batch Exists!');
        }
        return $students;
    }

    public function uploadAttendance($batch_id, $student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);

        $batch = BatchDetail::findOrFail($batch_id);

        $date = Date('d-m-Y');

        return view('teachers.upload-attendance.ua_upload_attendance')->with(['student' => $student, 'batch' => $batch, 'date' => $date]);
    }

    public function saveUploadedAttendance(Request $request)
    {
        $uploadedAttendance = new AttendanceDetails($request->all());

        $uploadedAttendance->Att_Date = Date('Y-m-d');

        if ($uploadedAttendance->save())
            return redirect('teacher/upload-attendance')->with('message', 'Attendance uploaded successfully!');
        else
            return back()->with('message', 'Could not upload attendance. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Study Material Upload
    |------------------------------------------------------------------------------
    */
    public function uploadStudyMaterial()
    {
        $teacher = $this->getCurrentTeacher();

        $batches = $this->getAssociatedBatches();

        $uploadedFiles = DB::table('study_material_details')->where([['SM_User_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->orderBy('SM_Upload_Date', 'DESC')->get();

        return view('teachers.upload_study_material')->with(['batches' => $batches, 'teacher' => $teacher, 'uploadedFiles' => $uploadedFiles]);
    }

    public function saveUploadedStudyMaterial(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->SM_Batch_Id);

        if ($request->hasFile('File_Name') && $request->has('SM_Batch_Id')) {
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
        } else
            return back()->with('message', 'Could not upload study material. Try again!');
    }

    public function deleteUploadedStudyMaterial($id)
    {
        $studyMaterial = StudyMaterialDetails::findOrFail($id);

        $studyMaterial->Ent_Type = 'D';

        if ($studyMaterial->save()) {
            $path = storage_path('app\public\uploads\study-materials');

            if (File::exists($path . '\\' . $studyMaterial->SM_File_Name))
                File::delete($path . '\\' . $studyMaterial->SM_File_Name);

            return back()->with('message', 'Study material deleted!');
        } else
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

        $batch_ids = DB::table('t_s_batch_relations')->where([['TSB_T_Stu_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->pluck('TSB_Batch_Id');

        $batches = [];

        foreach ($batch_ids as $index => $id) {
            $batches[$id] = BatchDetail::findOrFail($id);
        }

        $uploadedFiles = DB::table('mock_test_details')->where([['MT_User_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->orderBy('MT_Upload_Date', 'DESC')->get();

        return view('teachers.upload_mock_test_or_practice_paper')->with(['batches' => $batches, 'teacher' => $teacher, 'uploadedFiles' => $uploadedFiles]);
    }

    public function saveUploadedMockTestOrPracticePaper(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->MT_Batch_Id);

        if ($request->hasFile('File_Name') && $request->has('MT_Batch_Id')) {
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
        } else
            return back()->with('message', 'Could not upload test/practice paper. Try again!');
    }

    public function deleteUploadedMockTestOrPracticePaper($id)
    {
        $mockTestOrPracticePaper = MockTestDetails::findOrFail($id);

        $mockTestOrPracticePaper->Ent_Type = 'D';

        if ($mockTestOrPracticePaper->save()) {
            $path = storage_path('app\public\uploads\mock-test-OR-practice-papers');

            if (File::exists($path . '\\' . $mockTestOrPracticePaper->MT_File_Name))
                File::delete($path . '\\' . $mockTestOrPracticePaper->MT_File_Name);

            return back()->with('message', 'Test / practice paper deleted!');
        } else
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

        $batches = $this->getAssociatedBatches();

        $uploadedFiles = DB::table('assignments_teacher_uploads')->where([['ATU_User_Id', $teacher->id], ['Ent_Type', '<>', 'D']])->orderBy('ATU_Upload_Date', 'DESC')->get();

        return view('teachers.upload_assignment')->with(['batches' => $batches, 'teacher' => $teacher, 'uploadedFiles' => $uploadedFiles]);
    }

    public function saveUploadedAssignment(Request $request)
    {
        $batch = BatchDetail::findOrFail($request->ATU_Batch_Id);

        if ($request->hasFile('File_Name') && $request->has('ATU_Batch_Id')) {
            $uploadedFile = $request->file('File_Name');

            $fileName = $request->File_Name->getClientOriginalName();

            $path = Storage::putFileAs('uploads\assignments\teacher-uploads', $uploadedFile, $fileName);

            $assignment = new AssignmentsTeacherUpload($request->all());

            $assignment->ATU_File_Name = $fileName;

            $assignment->ATU_Subject = $batch->Batch_Subject;

            $assignment->ATU_Upload_Date = Date('Y-m-d');

            $assignment->Role_Type = 'T';

            if ($assignment->save())
                return redirect('teacher/upload-assignment')->with('message', 'Assignment uploaded successfully!');
            else
                return back()->with('message', 'Could not save assignment. Try again!');
        } else
            return back()->with('message', 'Could not upload assignment. Try again!');
    }

    public function deleteUploadedAssignment($id)
    {
        $assignment = AssignmentsTeacherUpload::findOrFail($id);

        $assignment->Ent_Type = 'D';

        if ($assignment->save()) {
            $path = storage_path('app\public\uploads\assignments\teacher-uploads');

            if (File::exists($path . '\\' . $assignment->ATU_File_Name))
                File::delete($path . '\\' . $assignment->ATU_File_Name);

            return back()->with('message', 'Assignment deleted!');
        } else
            return back()->with('message', 'Could not delete assignment. Try again!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for downloading students' assignments
    |------------------------------------------------------------------------------
    */
    public function selectBatchForDownloadingStudentAssignments()
    {
        $batches = $this->getAssociatedBatches();

        return view('teachers.download-student-assignments.dsa_select_batch')->with('batches',$batches);
    }

    public function selectStudentForDownloadingAssignments()
    {
        if (Input::has('Batch_Id')) {
            $batch_id = Input::get('Batch_Id');

            $students = $this->getStudentsByBatch($batch_id);

            return view('teachers.download-student-assignments.dsa_select_student')->with(['students' => $students, 'batch_id' => $batch_id]);
        }
    }

    public function downloadStudentAssignments($batch_id, $student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);
        $assignments = AssignmentsStudentUpload::where([['ASU_Batch_Id','=',$batch_id],['ASU_User_Id','=',$student_id],['Ent_Type','<>','D']])->get();
        return view('teachers.download-student-assignments.dsa_download_assignments')->with(['assignments'=>$assignments,'student'=>$student]);
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Setting Exams
    |------------------------------------------------------------------------------
    */
    public function uploadExamDetails()
    {
        $batches = $this->getAssociatedBatches();

        return view('teachers.set-exams.upload_exam_details')->with('batches', $batches);
    }

    public function saveExamDetails(Request $request)
    {
        $teacher = $this->getCurrentTeacher();

        $examDetails = ExamUploadDetails::firstOrCreate([
            'EU_User_Id' => $teacher->id,
            'EU_Batch_Id' => $request->EU_Batch_Id,
            'EU_Name' => $request->EU_Name,
            'EU_Duration' => $request->EU_Duration,
            'EU_No_of_Q' => $request->EU_No_of_Q,
            'EU_Instr' => $request->EU_Instr,
            'EU_Upload_Date' => Date('Y-m-d'),
            'Role_Type' => 'T'
        ]);

        if ($examDetails->save())
            return view('teachers.set-exams.upload_exam_questions')->with(['examDetails' => $examDetails, 'question_no' => 1]);
        else
            return back()->with('message', 'Could not upload exam details. Try again!');
    }

    public function saveExamQuestions(Request $request)
    {
        $examDetails = ExamUploadDetails::findOrFail($request->EQ_EU_Id);

        $question = ExamQuestionDetails::firstOrCreate([
            'EQ_EU_Id' => $request->EQ_EU_Id,
            'EQ_No_of_Q' => $request->EQ_No_of_Q,
            'EQ_Q_Number' => $request->EQ_Q_Number,
            'EQ_Q_Type' => $request->EQ_Q_Type,
            'EQ_Q' => $request->EQ_Q,
            'EQ_Op1' => $request->EQ_Op1,
            'EQ_Op2' => $request->EQ_Op2,
            'EQ_Op3' => $request->EQ_Op3,
            'EQ_Op4' => $request->EQ_Op4,
            'EQ_Ans' => $request->EQ_Ans,
            'Marks' => $request->Marks
        ]);

        if ($question->save()) {
            if ($question->EQ_Q_Number == $question->EQ_No_of_Q)
                return redirect()->action('TeacherController@viewUploadedExam', $examDetails->id);
            else
                return view('teachers.set-exams.upload_exam_questions')->with(['examDetails' => $examDetails, 'question_no' => $question->EQ_Q_Number + 1]);
        } else
            return back()->with('message', 'Could not upload question. Try again!');

    }

    public function viewUploadedExam($exam_id)
    {
        try {
            $examDetails = ExamUploadDetails::findOrFail($exam_id);
            $examQuestions = ExamQuestionDetails::where([['EQ_EU_Id', '=', $examDetails->id], ['Ent_Type', '<>', 'D']])->get();

            return view('teachers.set-exams.view_uploaded_exam')->with(['examDetails' => $examDetails, 'examQuestions' => $examQuestions, 'question_no' => 1]);

        } catch (ModelNotFoundException $e) {
            return redirect('teacher/set-exam')->with('message', 'Could not upload exam. Try again!');
        }
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Checking Students' Answer
    |------------------------------------------------------------------------------
    */
    public function selectBatchForCheckingAnswers()
    {
        $batches = $this->getAssociatedBatches();

        return view('teachers.check-students-answers.ca_select_batch')->with('batches', $batches);
    }

    public function selectExamForCheckingAnswers()
    {
        if (Input::has('Batch_Id')) {
            $batch_id = Input::get('Batch_Id');

            $teacher = $this->getCurrentTeacher();

            $exams = ExamUploadDetails::where([['EU_Batch_Id', '=', $batch_id], ['EU_User_Id', '=', $teacher->id], ['Ent_Type', '<>', 'D']])->get();

            return view('teachers.check-students-answers.ca_select_exam')->with(['exams' => $exams]);

        }
    }

    public function selectStudentForCheckingAnswers($id)
    {
        $students = $this->findStudentsWithUncheckedAnswers($id);

        return view('teachers.check-students-answers.ca_select_student')->with(['students' => $students, 'exam_id' => $id]);
    }

    public function findStudentsWithUncheckedAnswers($id)
    {
        try {
            $student_ids = DB::table('exam_response_details')->where([['ER_EU_Id', '=', $id], ['ER_Marks_Obt', '=', null], ['Ent_Type', '=', 'I']])->pluck('ER_User_Id');

            $students = [];

            foreach ($student_ids as $index => $id) {
                $students[$id] = TeacherStudentDetail::findOrFail($id);
            }

        } catch (ModelNotFoundException $e) {
            return back()->with('message', 'No Such Student Exists!');
        }
        return $students;
    }

    public function checkAnswers($exam_id, $student_id)
    {
        $totalSubmittedAnswers = DB::table('exam_response_details')->where([['ER_EU_Id', '=', $exam_id], ['ER_User_Id', '=', $student_id], ['ER_Marks_Obt', '=', null]])->count();

        $firstAnswer = DB::table('exam_response_details')->where([['ER_EU_Id', '=', $exam_id], ['ER_User_Id', '=', $student_id], ['ER_Marks_Obt', '=', null]])->first();

        $firstQuestion = DB::table('exam_question_details')->where('id', '=', $firstAnswer->ER_EQ_Id)->first();

        return view('teachers.check-students-answers.ca_check_answers')->with(['question' => $firstQuestion, 'answer' => $firstAnswer, 'totalSubmittedAnswers' => $totalSubmittedAnswers, 'question_no' => 1, 'totalMarks' => 0, 'obtainedMarks' => 0]);
    }

    public function saveObtainedMarks($exam_id, $student_id, Request $request)
    {
        $question_no = $request->question_no;
        $answer = ExamResponseDetails::findOrFail($request->answer_id);
        $answer->ER_Marks_Obt = $request->ER_Marks_Obt;
        $answer->Ent_Type = 'E';

        $totalMarks = $request->totalMarks + $request->Marks;
        $obtainedMarks = $request->obtainedMarks + $request->ER_Marks_Obt;

        if ($answer->save()) {
            if ($request->totalSubmittedAnswers == $question_no) {
                $examDetails = ExamUploadDetails::findOrFail($exam_id);
                $student = TeacherStudentDetail::findOrFail($student_id);
                return view('teachers.check-students-answers.ca_upload_marks')->with(['student' => $student, 'examDetails' => $examDetails, 'totalMarks' => $totalMarks, 'obtainedMarks' => $obtainedMarks]);
            } else {
                $nextAnswer = DB::table('exam_response_details')->where([['ER_EU_Id', '=', $exam_id], ['ER_User_Id', '=', $student_id], ['ER_Marks_Obt', '=', null], ['Ent_Type', 'I']])->first();

                $question = DB::table('exam_question_details')->where('id', '=', $nextAnswer->ER_EQ_Id)->first();

                return view('teachers.check-students-answers.ca_check_answers')->with(['question' => $question, 'answer' => $nextAnswer, 'totalSubmittedAnswers' => $request->totalSubmittedAnswers, 'question_no' => $question_no + 1, 'totalMarks' => $totalMarks, 'obtainedMarks' => $obtainedMarks]);
            }
        } else
            return back()->with('message', 'Could not upload question. Try again!');

    }

    public function uploadStudentPerformance($exam_id, $student_id, Request $request)
    {
        $examDetails = ExamUploadDetails::findOrFail($exam_id);
        $batch = BatchDetail::findOrFail($examDetails->EU_Batch_Id);

        $studentPerformanceDetails = PerformanceDetails::firstOrCreate([
            'Per_User_Id' => $student_id,
            'Per_Batch_Id' => $batch->id,
            'Per_Exam_Id' => $exam_id,
            'Per_Subject' => $batch->Batch_Subject,
            'Per_Marks' => $request->Per_Marks,
            'Per_Tot_Marks' => $request->Per_Tot_Marks,
            'Role_Type' => 'S'
        ]);
        return redirect('teacher/check-student-answers')->with('message', 'Marks Uploaded Successfully!');
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Displaying Students' Performance Report
    |------------------------------------------------------------------------------
    */
    public function selectBatchForStudentPerformanceReport()
    {
        $batches = $this->getAssociatedBatches();

        return view('teachers.student-performance-report.pr_select_batch')->with('batches', $batches);
    }

    public function selectStudentForStudentPerformanceReport()
    {
        if (Input::has('Batch_Id'))
        {
            $batch_id = Input::get('Batch_Id');

            $student_ids = PerformanceDetails::where([['Per_Batch_Id',$batch_id],['Ent_Type','<>','D']])->pluck('Per_User_Id');

            $students = [];

            foreach ($student_ids as $index => $id) {
                $students[$id] = TeacherStudentDetail::findOrFail($id);
            }

            return view('teachers.student-performance-report.pr_select_student')->with(['students' => $students, 'batch_id' => $batch_id]);
        }
    }

    public function displayStudentPerformanceReport($batch_id,$student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);
        $performanceReport= [];
        $performanceDetails = PerformanceDetails::where([['Per_Batch_Id',$batch_id],['Per_User_Id',$student_id],['Ent_Type','<>','D']])->get();

        foreach ($performanceDetails as $performanceDetail)
        {
            $examDetails = ExamUploadDetails::findOrFail($performanceDetail->Per_Exam_Id);
            $examReport['Exam_Name'] = $examDetails->EU_Name;
            $examReport['Upload_Date'] = $examDetails->EU_Upload_Date;
            $examReport['Total_Marks'] = $performanceDetail->Per_Tot_Marks;
            $examReport['Obtained_Marks'] = $performanceDetail->Per_Marks;
            $examReport['Percentage'] = round(($performanceDetail->Per_Marks / $performanceDetail->Per_Tot_Marks)*100);
            array_push($performanceReport,$examReport);
        }

        return view('teachers.student-performance-report.pr_display_performance_report')->with(['student' => $student, 'performanceReport' => $performanceReport]);
    }

    /*
    |------------------------------------------------------------------------------
    | Methods for Displaying Students' Attendance Report
    |------------------------------------------------------------------------------
    */
    public function selectBatchForStudentAttendanceReport()
    {
        $batches = $this->getAssociatedBatches();

        return view('teachers.student-attendance-report.ar_select_batch')->with('batches', $batches);
    }

    public function selectStudentForStudentAttendanceReport()
    {
        if (Input::has('Batch_Id'))
        {
            $batch_id = Input::get('Batch_Id');

            $student_ids = AttendanceDetails::where([['Att_Batch_Id',$batch_id],['Ent_Type','<>','D']])->pluck('Att_User_Id');

            $students = [];

            foreach ($student_ids as $index => $id) {
                $students[$id] = TeacherStudentDetail::findOrFail($id);
            }

            return view('teachers.student-attendance-report.ar_select_student')->with(['students' => $students, 'batch_id' => $batch_id]);
        }
    }

    public function displayStudentAttendanceReport($batch_id,$student_id)
    {
        $student = TeacherStudentDetail::findOrFail($student_id);
        $presentCount = 0;
        $absentCount = 0;
        $attendanceReport = [];
        $attendanceDetails = AttendanceDetails::where([['Att_Batch_Id',$batch_id],['Att_User_Id',$student_id],['Ent_Type','<>','D']])->get();
        //dd($attendanceDetails);
        foreach ($attendanceDetails as $attendanceDetail)
        {
            if($attendanceDetail->Att_Present_YN == 'YES')
                $presentCount++;
            elseif($attendanceDetail->Att_Present_YN == 'NO')
                $absentCount++;
        }

        $totalCount = $presentCount+$absentCount;
        if($totalCount != 0)
        {
            $attendanceReport['presentCount'] = $presentCount;
            $attendanceReport['absentCount'] = $absentCount;
            $attendanceReport['totalCount'] = $totalCount;
            $attendanceReport['percentage'] = round(($presentCount/$attendanceReport['totalCount'])*100);
        }

        return view('teachers.student-attendance-report.ar_display_attendance_report')->with(['student' => $student,'attendanceDetails'=>$attendanceDetails, 'attendanceReport'=>$attendanceReport]);
    }
}
