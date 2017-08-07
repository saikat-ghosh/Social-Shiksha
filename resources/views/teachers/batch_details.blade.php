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
                <a  href="{{url('/teacher/batches')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Edit Batch</a>
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
                <a  href="{{url('/teacher/check-notice')}}" class="list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> View Notice Board</a>
            </li>
        </ul>
    @endsection

    @section('menu-content')
            <!-- Batch Details for the particular teacher goes here -->
            <div id="view-batches" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Batches you are currently associated with</div>
                        <div class="panel-body">
                            <div>
                                @if(empty($teacherBatches))
                                    <h4>You are not currently associated with any batches.</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($teacherBatches as $id=>$batch)
                                            <li class="list-group-item">
                                                <strong>{{ $batch->Batch_Code }}</strong>&nbsp;&nbsp;
                                                {{ $batch->Batch_Subject }}
                                                <span class="badge">
                                                    <form action="{{ action('TeacherController@removeBatch',$id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="delete">
                                                            <button type="submit" class="btn-xs btn-link white-text">Delete</button>
                                                    </form>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('BatchController@create') }}" class="btn btn-info pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-plus-sign"></span>&thinsp;Join Batch</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection