
@extends('layouts.dashboard-layout')

    @section('navbar-menu-left')

        <!-- Left Navbar menu goes here -->
            <ul class="nav" id="main-menu">
                <li>
                    <a  href="{{url('student/dashboard')}}"><i class="fa fa-home fa-2x"></i> Home</a>
                </li>
                <li>
                    <a  href="{{url('student/view-profile')}}"><i class="fa fa-user fa-2x"></i> Profile</a>
                </li>
                <li>
                    <a  href="{{url('student/batch-details')}}" class="active-menu"><i class="fa fa-edit fa-2x"></i> Batches</a>
                </li>
                <li>
                    <a  href="{{url('student/download-study-material')}}"><i class="fa fa-download fa-2x"></i> Download Study Material</a>
                </li>
                <li>
                    <a   href="{{url('student/download-test-or-practice-paper')}}"><i class="fa fa-download fa-2x"></i> Download Mock Test/Practice Paper</a>
                </li>
                <li>
                    <a  href="{{url('student/upload-assignment')}}"><i class="fa fa-upload fa-2x"></i> Upload Assignment</a>
                </li>
                <li>
                    <a  href="{{url('student/download-assignment')}}"><i class="fa fa-download fa-2x"></i> Download Assignment</a>
                </li>
                <li>
                    <a  href="{{url('student/give-exam')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Give Exams</a>
                </li>
                <li>
                    <a  href="{{url('student/discussion-forum')}}"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                </li>
                <li>
                    <a  href="{{url('student/notice-board')}}"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                </li>
            </ul>
    @endsection


    @section('menu-content')
        <!-- Student dashboard goes here -->
        <h1 style="font-family: Montserrat, Lato; color: red; text-decoration: none;font-size: 65%; text-shadow: 4px 4px 6px gray;font-style: none;"><u style="list-style: none;text-decoration: none;"><b> Batch Details</b></u></h1>
    @endsection