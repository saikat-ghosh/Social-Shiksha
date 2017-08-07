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

Route::group(['prefix'=>'institution','middleware'=>['auth','isInstitution']],function() {

    Route::get('/dashboard', 'InstitutionController@dashboard');

    Route::get('/view-profile', 'InstitutionController@view_profile');

    Route::post('/view-profile', 'InstitutionController@edit_profile');

    Route::post('/edit-profile', 'InstitutionController@update_profile');

    Route::get('/teacher-details', 'InstitutionController@show_teacher_details');

    Route::get('/student-details', 'InstitutionController@show_student_details');

    Route::get('/notice-board', 'InstitutionController@showNoticeBoard');

    Route::resource('batch-details','BatchController');

    Route::put('/teacher-details/{id}','InstitutionController@delete_teacher_student_record');

    Route::put('/student-details/{id}','InstitutionController@delete_teacher_student_record');
});

Route::group(['prefix'=>'teacher','middleware'=>['auth','isTeacher']],function() {

    Route::get('/dashboard', 'TeacherController@dashboard');

    Route::get('/view-profile', 'TeacherController@viewProfile');

    Route::get('/edit-profile', 'TeacherController@editProfile');

    Route::post('/edit-profile', 'TeacherController@updateProfile');

    Route::get('/batches','TeacherController@showBatches');

    Route::post('/batches','TeacherController@assignBatch');

    Route::delete('/batches/{id}','TeacherController@removeBatch');

    Route::get('upload-student-marks','TeacherController@selectBatchForMarksUpload');

    Route::post('upload-student-marks/students','TeacherController@selectStudentForMarksUpload');

    Route::post('upload-student-marks/batch/{batch_id}/student/{id}','TeacherController@uploadMarks');

    Route::post('upload-student-marks/upload','TeacherController@saveUploadedMarks');

    Route::get('upload-attendance','TeacherController@selectBatchForAttendanceUpload');

    Route::post('upload-attendance/students','TeacherController@selectStudentForAttendanceUpload');

    Route::post('upload-attendance/batch/{batch_id}/student/{id}','TeacherController@uploadAttendance');

    Route::post('upload-attendance/upload','TeacherController@saveUploadedAttendance');

    Route::get('upload-study-material','TeacherController@uploadStudyMaterial');

    Route::post('upload-study-material','TeacherController@saveUploadedStudyMaterial');

    Route::delete('delete-study-material/{id}','TeacherController@deleteUploadedStudyMaterial');

    Route::get('upload-test-or-practice-paper','TeacherController@uploadMockTestOrPracticePaper');

    Route::post('upload-test-or-practice-paper','TeacherController@saveUploadedMockTestOrPracticePaper');

    Route::delete('delete-test-or-practice-paper/{id}','TeacherController@deleteUploadedMockTestOrPracticePaper');

    Route::get('upload-assignment','TeacherController@uploadAssignment');

    Route::post('upload-assignment','TeacherController@saveUploadedAssignment');

    Route::delete('delete-assignment/{id}','TeacherController@deleteUploadedAssignment');

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

    Route::get('/batches','StudentController@show_batches');

    Route::post('/batches','StudentController@assign_batch');

    Route::delete('/batches/{id}','StudentController@remove_batch');

});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/clear', 'HomeController@truncateDB');


/*
|------------------------------------------------------------------------------
| Add new routes here for new branches
|------------------------------------------------------------------------------
*/


