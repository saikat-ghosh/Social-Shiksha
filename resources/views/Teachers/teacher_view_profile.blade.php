@extends('layouts.dashboard-layout')

    @section('navbar-menu-left')

        <!-- Left Navigation Bar menu -->
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="{{url('/teacher/dashboard')}}"><i class="fa fa-home fa-2x"></i> Welcome Page</a>
                    </li>
                    <li>
                        <a  href="#" class="active-menu"><i class="fa fa-user fa-2x"></i> Profile</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/edit-batch')}}"><i class="fa fa-edit fa-2x"></i> Edit Batch</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/upload-student-marks')}}"><i class="fa fa-upload fa-2x"></i> Student Performance Marks Upload</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/upload-attendance')}}"><i class="fa fa-upload fa-2x"></i> Student Attendance Upload</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/student-performance-report')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Student Performance Details Report</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/student-attendance-report')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Student Attendance Details Report</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/upload-study-material')}}"><i class="fa fa-upload fa-2x"></i> Study Material Upload</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/upload-test-or-practice-paper')}}"><i class="fa fa-upload fa-2x"></i> Mock Test/Practice Paper Upload</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/upload-assignment')}}"><i class="fa fa-upload fa-2x"></i> Assignment Upload</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/download-assignment')}}"><i class="fa fa-download fa-2x"></i> Assignment Download</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/set-exam')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Set Exams</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/check-student-answers')}}"><i class="fa fa-upload fa-2x"></i> Student Answers Check</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/discussion-forum')}}"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/add-notice')}}"><i class="fa fa-plus fa-2x"></i> Add Notice</a>
                    </li>
                    <li>
                        <a  href="{{url('/teacher/check-notice')}}"><i class="fa fa-bell-o fa-2x"></i> View Notice Board</a>
                    </li>
                </ul>
    @endsection

    @section('page-content')
        <!-- Menu Content  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="images/logo.png" alt="logo">
                                <p> <br> </p>
                                <div style="font-size: 120px;">
                                    <h1 style="font-family: Montserrat, Lato; color: red; text-decoration: none;font-size: 65%; text-shadow: 4px 4px 6px gray;font-style: none;"><u style="list-style: none;text-decoration: none;"><b> Welcome</b></u></h1>
                                </div>
                            </center>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <!-- /. PAGE INNER  -->
                </div>
                <!-- /. PAGE WRAPPER  -->
            </div>
    @endsection