@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar Menu goes here-->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('institution/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                </li>
                <li>
                    <a  href="{{url('institution/view-profile')}}" class="list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
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
                    <a  href="{{url('institution/notice-board')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
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