@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar menu goes here -->
                <ul class="list-group sidebar-list" id="sidebar">
                    <li>
                        <a  href="{{url('student/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                    </li>
                    <li>
                        <a  href="{{url('student/view-profile')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                    </li>
                    <li>
                        <a  href="{{url('student/batch-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Batches</a>
                    </li>
                    <li>
                        <a  href="{{url('student/download-study-material')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Study Material</a>
                    </li>
                    <li>
                        <a   href="{{url('student/download-test-or-practice-paper')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Mock Test/Practice Paper</a>
                    </li>
                    <li>
                        <a  href="{{url('student/upload-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Assignment</a>
                    </li>
                    <li>
                        <a  href="{{url('student/download-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Assignment</a>
                    </li>
                    <li>
                        <a  href="{{url('student/give-exam')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Give Exams</a>
                    </li>
                    <li>
                        <a  href="{{url('student/discussion-forum')}}" class="list-group-item sidebar-list-item"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                    </li>
                    <li>
                        <a  href="{{url('student/notice-board')}}" class="list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>
                </ul>
    @endsection