@extends('layouts.dashboard-layout')

    @section('navbar-menu-left')

        <!-- Left Navigation Bar menu -->
                <ul class="nav" id="main-menu">
				    <li>
                        <a  href="#" class="active-menu"><i class="fa fa-home fa-2x"></i> Welcome Page</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/view-profile')}}"><i class="fa fa-user fa-2x"></i> Edit Profile</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/batch-details')}}"><i class="fa fa-edit fa-2x"></i> Batches</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/teacher-details')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Teacher Details Report</a>
                    </li>
                    <li  >
                        <a  href="{{url('institution/student-details')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details Report</a>
                    </li>
					<li>
                        <a  href="{{url('institution/notice-board')}}"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>
                </ul>
	@endsection
		

    @section('menu-content')
        <!-- Institution dashboard goes here -->
        <h1 style="font-family: Montserrat, Lato; color: red; text-decoration: none;font-size: 65%; text-shadow: 4px 4px 6px gray;font-style: none;"><u style="list-style: none;text-decoration: none;"><b> Welcome</b></u></h1>
    @endsection