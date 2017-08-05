@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar menu goes here -->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('/teacher/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i>Home</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/view-profile')}}" class="list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/batches')}}" class="list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Edit Batch</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-student-marks')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Student Performance Marks</a>
                </li>
                <li>
                    <a   href="{{url('/teacher/upload-attendance')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Student Attendance</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/student-performance-report')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Performance Details Report</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/student-attendance-report')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Attendance Details Report</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-study-material')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Study Material</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-test-or-practice-paper')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Mock Test/Practice Paper</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Assignment</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/download-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Assignment</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/set-exam')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Set Exams</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/check-student-answers')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Check Student Answers</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/discussion-forum')}}" class="list-group-item sidebar-list-item"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/add-notice')}}" class="list-group-item sidebar-list-item"><i class="fa fa-plus fa-2x"></i> Add Notice</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/check-notice')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> View Notice Board</a>
                </li>
            </ul>
@endsection

@section('menu-content')
        <!-- Form for adding new notice goes here -->
        <div id="edit-notice" class="row padding">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Notice</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="Notice_Heading" class="col-md-5 control-label">Notice Heading :</label>
                                <div class="col-md-6">
                                    <input id="Notice_Heading" class="form-control" type="text" name ="NB_Heading" value="{{ $notice->NB_Heading }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Notice_Body" class="col-md-5 control-label">Notice Body :</label>
                                <div class="col-md-6">
                                    <textarea id="Notice_Body" class="form-control" name ="NB_Content" rows="4" cols="7">{{ $notice->NB_Content }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    <button type="submit" class="btn btn-info pull-right">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection