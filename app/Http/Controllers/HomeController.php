<?php

namespace App\Http\Controllers;

use App\CoachingDetails;
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
          echo"homepage";
    }

    public function truncateDB()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        TeacherStudentDetail::truncate();
        CoachingDetails::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect('/');
    }
}
