@extends('layouts.teacher_layouts.check_students_answers_layout')

    @section('menu-content')
        <!-- Select students for attendance upload -->
            <div id="select-student" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Check Students' Answers</div>
                        <div class="panel-body">
                            <div>
                                @if(empty($students))
                                    <h4>No students found against your search. Refine search and try again!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($students as $id=>$student)
                                            <li class="list-group-item">
                                                <strong>{{ $student->T_Stu_Name }}</strong>&nbsp;&nbsp;
                                                {{ $student->T_Stu_No }}

                                                    <a href="{{ action('TeacherController@checkAnswers',[$exam_id,$student->id]) }}"
                                                        class="btn-xs btn-link pull-right">Check Answers</a>

                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('TeacherController@selectBatchForCheckingAnswers') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-backward"></span>&thinsp;Back to Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection