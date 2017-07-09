@extends('layouts.dashboard-layout')

    @section('navbar-menu-left')

        <!-- Left Navigation Bar menu -->
                <ul class="nav" id="main-menu">
				    <li>
                        <a  href="{{url('institution/dashboard')}}"><i class="fa fa-home fa-2x"></i> Welcome Page</a>
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
                    <li>
                        <a   href="{{url('institution/student-details')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details Report</a>
                    </li>
					<li>
                        <a class="active-menu" href="#"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>		
                </ul>

    @endsection

    @section('menu-content')
            <!-- Institution notice-board goes here -->
            <h2><b>Notices</b></h2>
             
            <!--table class="table table-responsive table-striped table-bordered">
                   <tr>
                       <th>Sl. no.</th>
                       <th>Notice </th>

                       <th>Date</th>
                   </tr>
            </table-->
    @endsection