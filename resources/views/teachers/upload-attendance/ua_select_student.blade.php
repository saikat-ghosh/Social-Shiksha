@extends('layouts.teacher_layouts.upload_students_attendance_layout')

    @section('menu-content')
        <!-- Select students for attendance upload -->
            <div id="select-student" class="row padding">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Upload Attendance
                                <a href="{{ action('TeacherController@selectBatchForAttendanceUpload') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-chevron-left"></span>&thinsp;Back</a>
                        </div>
                        <div class="panel-body">
                            <div>
                                @if(empty($students))
                                    <h4>No students found against your search!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($students as $id=>$student)
                                            <li class="list-group-item">
                                                <strong>{{ $student->T_Stu_Name }}</strong>&nbsp;&nbsp;
                                                {{ $student->T_Stu_No }}
                                                <span class="badge">
                                                    <form action="{{ action('TeacherController@uploadAttendance',[$batch_id,$student->id]) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn-xs btn-link white-text">Upload</button>
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