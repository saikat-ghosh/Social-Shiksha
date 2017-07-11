@extends('layouts.dashboard-layout')


    @section('navbar-menu-left')

            <!-- Left Navigation Bar menu -->
                <ul class="nav" id="main-menu">
                    <li>
                        <a  href="{{url('institution/dashboard')}}"><i class="fa fa-home fa-2x"></i> Home</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/view-profile')}}"><i class="fa fa-user fa-2x"></i> Profile</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/batch-details')}}"><i class="fa fa-edit fa-2x"></i> Batches</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/teacher-details')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Teacher Details</a>
                    </li>
                    <li  >
                        <a  href="#" class="active-menu"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/notice-board')}}"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>
                </ul>
    @endsection


    @section('menu-content')
            <!-- Institution's teacher details goes here -->
    @endsection