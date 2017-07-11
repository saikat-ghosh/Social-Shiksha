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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix'=>'institution','middleware'=>'isInstitution'],function() {

    Route::any('/dashboard', function () {
        return view('institutions.institution_dashboard');
    });
    Route::get('/view-profile', function () {
        return view('institutions.institution_view_profile');
    });
    Route::get('/batch-details', function () {
        return view('institutions.institution_show_batch_details');
    });
    Route::get('/teacher-details', function () {
        return view('institutions.institution_show_teacher_details');
    });
    Route::get('/student-details', function () {
        return view('institutions.institution_show_student_details');
    });
    Route::get('/notice-board', function () {
        return view('institutions.institution_notice_board');
    });
});

Route::group(['prefix'=>'teacher','middleware'=>'isTeacher'],function() {

    Route::any('/dashboard', function () {
        return view('teachers.teacher_dashboard');
    });
    Route::get('/view-profile', function () {
        return view('teachers.teacher_view_profile');
    });
});

Route::group(['prefix'=>'student','middleware'=>'isStudent'],function() {

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