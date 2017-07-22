@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar menu goes here -->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('institution/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                </li>
                <li>
                    <a  href="{{url('institution/view-profile')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                </li>
                <li>
                    <a  href="{{url('institution/batch-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Batches</a>
                </li>
                <li>
                    <a  href="{{url('institution/teacher-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Teacher Details</a>
                </li>
                <li  >
                    <a  href="{{url('institution/student-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details</a>
                </li>
                <li>
                    <a  href="{{url('institution/notice-board')}}" class="list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                </li>
            </ul>
    @endsection