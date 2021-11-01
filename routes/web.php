<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Master branch routes by Saikat Ghosh
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
});


Route::get('admin', 'AdminController@showLoginForm');
Route::post('admin','AdminController@login');

Route::group(['prefix'=>'admin','middleware'=>[]],function() {

    Route::get('dashboard', 'AdminController@dashboard');

    Route::get('registration-fees','AdminController@selectUserType');

    Route::post('registration-fees/unpaid-users','AdminController@showUnpaidUsers');

    Route::get('registration-fees/{role_type}/{id}/pay','AdminController@payRegistrationFees');

    Route::post('logout','AdminController@logout');
});

Route::group(['prefix'=>'institution','middleware'=>['auth','isInstitution']],function() {

    Route::get('/dashboard', 'InstitutionController@dashboard');

    Route::get('/view-profile', 'InstitutionController@view_profile');

    Route::post('/view-profile', 'InstitutionController@edit_profile');

    Route::post('/edit-profile', 'InstitutionController@update_profile');

    Route::get('/teacher-details', 'InstitutionController@show_teacher_details')->middleware('RegistrationFeesPaid');

    Route::get('/student-details', 'InstitutionController@show_student_details');

    Route::get('/notice-board', 'InstitutionController@showNoticeBoard');

    Route::resource('batch-details','BatchController');

    Route::put('/teacher-details/{id}','InstitutionController@delete_teacher_student_record');

    Route::put('/student-details/{id}','InstitutionController@delete_teacher_student_record');
});

Route::group(['prefix'=>'teacher','middleware'=>['auth','isTeacher']],function() {

    Route::get('dashboard', 'TeacherController@dashboard');

    Route::get('view-profile', 'TeacherController@viewProfile');

    Route::get('edit-profile', 'TeacherController@editProfile');

    Route::post('edit-profile', 'TeacherController@updateProfile');

    Route::get('batches','TeacherController@showBatches')->middleware('RegistrationFeesPaid');

    Route::post('batches','TeacherController@assignBatch');

    Route::delete('batches/{id}','TeacherController@removeBatch');

    Route::get('upload-student-marks','TeacherController@selectBatchForMarksUpload');

    Route::post('upload-student-marks/students','TeacherController@selectStudentForMarksUpload');

    Route::post('upload-student-marks/batch/{batch_id}/student/{id}','TeacherController@uploadMarks');

    Route::post('upload-student-marks/upload','TeacherController@saveUploadedMarks');

    Route::get('upload-attendance','TeacherController@selectBatchForAttendanceUpload');

    Route::post('upload-attendance/students','TeacherController@selectStudentForAttendanceUpload');

    Route::post('upload-attendance/batch/{batch_id}/student/{id}','TeacherController@uploadAttendance');

    Route::post('upload-attendance/upload','TeacherController@saveUploadedAttendance');

    Route::get('student-performance-report','TeacherController@selectBatchForStudentPerformanceReport');

    Route::post('student-performance-report/students','TeacherController@selectStudentForStudentPerformanceReport');

    Route::get('student-performance-report/batch/{batch_id}/student/{student_id}','TeacherController@displayStudentPerformanceReport');

    Route::get('student-attendance-report','TeacherController@selectBatchForStudentAttendanceReport');

    Route::post('student-attendance-report/students','TeacherController@selectStudentForStudentAttendanceReport');

    Route::get('student-attendance-report/batch/{batch_id}/student/{student_id}','TeacherController@displayStudentAttendanceReport');

    Route::get('upload-study-material','TeacherController@uploadStudyMaterial');

    Route::post('upload-study-material','TeacherController@saveUploadedStudyMaterial');

    Route::delete('delete-study-material/{id}','TeacherController@deleteUploadedStudyMaterial');

    Route::get('upload-test-or-practice-paper','TeacherController@uploadMockTestOrPracticePaper');

    Route::post('upload-test-or-practice-paper','TeacherController@saveUploadedMockTestOrPracticePaper');

    Route::delete('delete-test-or-practice-paper/{id}','TeacherController@deleteUploadedMockTestOrPracticePaper');

    Route::get('upload-assignment','TeacherController@uploadAssignment');

    Route::post('upload-assignment','TeacherController@saveUploadedAssignment');

    Route::delete('delete-assignment/{id}','TeacherController@deleteUploadedAssignment');

    Route::get('download-assignment','TeacherController@selectBatchForDownloadingStudentAssignments');

    Route::post('download-assignment/students','TeacherController@selectStudentForDownloadingAssignments');

    Route::get('download-assignment/batch/{batch_id}/student/{student_id}','TeacherController@downloadStudentAssignments');

    Route::get('set-exam','TeacherController@uploadExamDetails');

    Route::post('set-exam','TeacherController@saveExamDetails');

    Route::get('upload-exam/{id}','TeacherController@viewUploadedExam');

    Route::post('set-exam/questions','TeacherController@saveExamQuestions');

    Route::get('check-student-answers','TeacherController@selectBatchForCheckingAnswers');

    Route::post('check-student-answers/exams','TeacherController@selectExamForCheckingAnswers');

    Route::post('check-student-answers/exam/{id}','TeacherController@selectStudentForCheckingAnswers');

    Route::get('check-student-answers/exam/{exam_id}/student/{stu_id}','TeacherController@checkAnswers');

    Route::post('check-student-answers/exam/{exam_id}/student/{stu_id}','TeacherController@saveObtainedMarks');

    Route::post('check-student-answers/exam/{exam_id}/student/{stu_id}/upload-marks','TeacherController@uploadStudentPerformance');

    Route::get('discussion-forum/{id}','DiscussionForumDetailsController@index')->name('post-detail');

    Route::post('discussion-forum/{id}','DiscussionForumDetailsController@store');

    Route::get('discussion-forum/{topic_id}/comment/{comment_id}/edit','DiscussionForumDetailsController@edit');

    Route::put('discussion-forum/{topic_id}/comment/{comment_id}','DiscussionForumDetailsController@update');

    Route::post('discussion-forum/topic/{topic_id}/comment/{id}','DiscussionForumDetailsController@destroy')->name('delete-comment');

    Route::resource('discussion-forum','DiscussionForumTopicController');

    Route::get('add-notice','NoticeBoardController@create');

    Route::post('add-notice','NoticeBoardController@store');

    Route::get('check-notice','NoticeBoardController@index');

    Route::get('check-notice/{id}/edit','NoticeBoardController@edit');

    Route::put('check-notice/{id}','NoticeBoardController@update');

    Route::delete('check-notice/{id}','NoticeBoardController@destroy');
});

Route::group(['prefix'=>'student','middleware'=>['auth','isStudent']],function() {

    Route::get('/dashboard', 'StudentController@dashboard');

    Route::get('/view-profile', 'StudentController@view_profile');

    Route::post('/view-profile', 'StudentController@edit_profile');

    Route::post('/edit-profile', 'StudentController@update_profile');

    Route::get('batch-details','StudentController@showBatches')->middleware('RegistrationFeesPaid');

    Route::post('batch-details','StudentController@assignBatch');

    Route::delete('batch-details/{id}','StudentController@removeBatch');

    Route::get('give-exam','StudentController@selectBatchForGivingExam');

    Route::post('give-exam','StudentController@selectExam');

    Route::get('give-exam/{id}','StudentController@confirmExam');

    Route::get('exam/{id}/question/{question_no}','StudentController@startExam');

    Route::post('exam/{id}/question/{question_no}','StudentController@saveStudentResponse');

    Route::get('download-study-material','StudentController@selectBatchForDownloadingStudyMaterials');

    Route::post('download-study-material','StudentController@downloadStudyMaterials');

    Route::get('download-test-or-practice-paper','StudentController@selectBatchForDownloadingMockTestOrPracticePapers');

    Route::post('download-test-or-practice-paper','StudentController@downloadMockTestOrPracticePapers');

    Route::get('download-assignment','StudentController@selectBatchForDownloadingAssignments');

    Route::post('download-assignment','StudentController@downloadAssignments');

    Route::get('upload-assignment','StudentController@uploadAssignment');

    Route::post('upload-assignment','StudentController@saveUploadedAssignment');

    Route::delete('delete-assignment/{id}','StudentController@deleteUploadedAssignment');

});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/clear', 'HomeController@truncateDB');


/*
|------------------------------------------------------------------------------
| Add new routes here for new branches
|------------------------------------------------------------------------------
*/


