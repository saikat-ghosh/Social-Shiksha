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
                        <a  href="{{url('institution/student-details')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/notice-board')}}" class="list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>
                </ul>
    @endsection


    @section('menu-content')
            <!-- Institution's teacher details goes here -->
            <div id="view-batches" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Enrolled Student Details</div>
                        <div class="panel-body">
                            <div>
                                @if($students->isEmpty())
                                    <h4>No students enrolled now.</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($students as $student)
                                            <li class="list-group-item">
                                                <strong>{{ $student->T_Stu_Name }}</strong>&nbsp;&nbsp;
                                                {{ $student->Batch_Id }}
                                                <span class="badge">
                                                    <form action="{{ action('InstitutionController@delete_teacher_student_record',$student->id) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <button type="submit" class="btn-xs btn-link white-text">Delete</button>
                                                    </form>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection