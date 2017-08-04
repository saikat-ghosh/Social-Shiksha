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

    Route::get('/notice-board', function () {
        return view('Institutions.institution_notice_board');
    });

    Route::resource('batch-details','BatchController');

    Route::put('/teacher-details/{id}','InstitutionController@delete_teacher_student_record');

    Route::put('/student-details/{id}','InstitutionController@delete_teacher_student_record');
});

Route::group(['prefix'=>'teacher','middleware'=>['auth','isTeacher']],function() {

    Route::get('/dashboard', 'TeacherController@dashboard');

    Route::get('/view-profile', 'TeacherController@view_profile');

    Route::post('/view-profile', 'TeacherController@edit_profile');

    Route::post('/edit-profile', 'TeacherController@update_profile');

    Route::get('/batches','TeacherController@show_batches');

    Route::post('/batches','TeacherController@assign_batch');

    Route::delete('/batches/{id}','TeacherController@remove_batch');
});

Route::group(['prefix'=>'student','middleware'=>['auth','isStudent']],function() {

    Route::any('/dashboard', function () {
        return view('students.student_dashboard');
    });
    Route::get('/view-profile', function () {
        return view('students.student_view_profile');
    });
    Route::get('/batch-details', function () {
        return view('students.student_show_batch_details');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/clear', 'HomeController@truncateDB');


/*
|------------------------------------------------------------------------------
| Add new routes here for new branches
|------------------------------------------------------------------------------
*/

Route::group(['prefix'=>'teacher','middleware'=>['auth','isTeacher']],function(){

    Route::get('discussion-forum/{id}','DiscussionForumDetailsController@index')->name('post-detail');

    Route::post('discussion-forum/{id}','DiscussionForumDetailsController@store');

    Route::get('discussion-forum/{topic_id}/comment/{comment_id}/edit','DiscussionForumDetailsController@edit');

    Route::put('discussion-forum/{topic_id}/comment/{comment_id}','DiscussionForumDetailsController@update');

    Route::post('discussion-forum/topic/{topic_id}/comment/{id}','DiscussionForumDetailsController@destroy')->name('delete-comment');

    Route::resource('discussion-forum','DiscussionForumTopicController');

    Route::get('add-notice','NoticeBoardController@create');

    Route::get('check-notice','NoticeBoardController@index');

    Route::get('check-notice/edit/{id}','NoticeBoardController@edit');

    Route::post('/add-notice','NoticeBoardController@store');
});