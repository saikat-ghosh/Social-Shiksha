@extends('layouts.teacher_layouts.check_students_answers_layout')

    @section('menu-content')
        <!-- Select exam for checking students' marks -->
            <div id="select-exam" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Check Students' Answers</div>
                        <div class="panel-body">
                            <div>
                                @if($exams->isEmpty())
                                    <h4>No exams found under this batch!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($exams as $exam)
                                            <li class="list-group-item">
                                                <strong>{{ $exam->EU_Name }}</strong>&nbsp;&nbsp;
                                                {{ $exam->EU_Upload_Date }}
                                                <span class="badge">
                                                    <form action="{{ action('TeacherController@selectStudentForCheckingAnswers',$exam->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn-xs btn-link white-text">Next&nbsp;<span class="glyphicon glyphicon-chevron-right"></span> </button>
                                                    </form>
                                                </span>
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