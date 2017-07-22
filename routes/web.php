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

Route::group(['prefix'=>'institution','middleware'=>['auth','isInstitution']],function() {

    Route::get('/dashboard', 'InstitutionController@dashboard');

    Route::get('/view-profile', 'InstitutionController@view-profile');

    Route::post('/view-profile', 'InstitutionController@edit-profile');

    Route::post('/edit-profile', 'InstitutionController@update-profile');

    Route::get('/teacher-details', 'InstitutionController@show_teacher_details');

    Route::get('/student-details', 'InstitutionController@show_student_details');

    Route::get('/notice-board', function () {
        return view('institutions.institution_notice_board');
    });

    Route::resource('batch-details','BatchController');

    Route::put('/teacher-details/{id}','InstitutionController@delete_teacher_student_record');

    Route::put('/student-details/{id}','InstitutionController@delete_teacher_student_record');
});

Route::group(['prefix'=>'teacher','middleware'=>[/*'auth','isTeacher'*/]],function() {

    Route::get('/dashboard', 'TeacherController@dashboard');

    Route::get('/view-profile', 'TeacherController@view-profile');

    Route::post('/view-profile', 'TeacherController@edit-profile');

    Route::post('/edit-profile', 'TeacherController@update-profile');

    Route::get('/batches','TeacherController@show-batches');

    Route::resource('teachers', 'TeacherController', ['except' => ['create', 'edit']]);

    Route::resource('question-types', 'QuestionTypeController', ['except' => ['create', 'edit']]);
});
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