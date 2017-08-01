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
        return view('institutions.institution_notice_board');
    });

    Route::resource('batch-details','BatchController');

    Route::put('/teacher-details/{id}','InstitutionController@delete_teacher_student_record');

    Route::put('/student-details/{id}','InstitutionController@delete_teacher_student_record');
});

Route::group(['prefix'=>'teacher','middleware'=>[/*'auth','isTeacher'*/]],function() {

    Route::get('/dashboard', 'TeacherController@dashboard');

    Route::get('/view-profile', 'TeacherController@view_profile');

    Route::post('/view-profile', 'TeacherController@edit_profile');

    Route::post('/edit-profile', 'TeacherController@update_profile');

    Route::get('/batches','TeacherController@show_batches');

    Route::post('/batches','TeacherController@assign_batch');

    Route::delete('/batches/{id}','TeacherController@remove_batch');

    Route::get('upload-student-marks','TeacherController@searchStudentFormForMarksUpload');

    Route::post('upload-student-marks','TeacherController@getStudentForMarksUpload');

    Route::post('upload-student-marks/batch/{batch_id}/student/{id}','TeacherController@showUploadMarksForm');

    Route::post('upload-student-marks/upload','TeacherController@saveUploadedMarks');

    Route::get('upload-attendance',function () {
        return view('demo3');
    });
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