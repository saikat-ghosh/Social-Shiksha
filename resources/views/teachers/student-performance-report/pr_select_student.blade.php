@extends('layouts.teacher_layouts.student_performance_report_layout')

    @section('menu-content')
        <!-- Select students for performance report -->
            <div id="select-student" class="row padding">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Student Performance Report
                            <a class="pull-right" href="{{ action('TeacherController@selectBatchForStudentPerformanceReport') }}"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Back </a>
                        </div>
                        <div class="panel-body">
                            <div>
                                @if(empty($students))
                                    <h4>No students found against your search.</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($students as $id=>$student)
                                            <li class="list-group-item">
                                                <strong>{{ $student->T_Stu_Name }}</strong>&nbsp;&nbsp;
                                                {{ $student->T_Stu_No }}

                                                    <a href="{{ action('TeacherController@displayStudentPerformanceReport',[$batch_id,$student->id]) }}"
                                                        class="btn-xs btn-info pull-right"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Show Report
                                                    </a>
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