<?php

namespace App\Http\Controllers;

use App\AdminDetail;
use App\CoachingDetails;
use App\ExamQuestionDetails;
use App\ExamResponseDetails;
use App\ExamUploadDetails;
use App\PerformanceDetails;
use App\TeacherStudentDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('truncateDB');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->Role_Type == 'C')
            return redirect('institution/dashboard');
        elseif($user->Role_Type == 'T')
            return redirect('teacher/dashboard');
        else
            return redirect('student/dashboard');
    }

    public function truncateDB()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        //User::truncate();
        //TeacherStudentDetail::truncate();
        //CoachingDetails::truncate();
        //ExamUploadDetails::truncate();
        //ExamQuestionDetails::truncate();
        //ExamResponseDetails::truncate();
        //PerformanceDetails::truncate();
        AdminDetail::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect('/');
    }
}
