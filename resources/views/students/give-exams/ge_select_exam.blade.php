@extends('layouts.student_layouts.give_exams_layout')

    @section('menu-content')
        <!-- Select pending exam  -->
            <div id="select-exam" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">List of Pending Exams</div>
                        <div class="panel-body">
                            <div>
                                @if(empty($exams))
                                    <h4>No pending exams under this batch!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($exams as $exam)
                                            <li class="list-group-item">
                                                <strong>{{ $exam->EU_Name }}</strong>&nbsp;&nbsp;
                                                {{ $exam->EU_Upload_Date }}
                                                <span class="badge">
                                                    <form action="{{ action('StudentController@confirmExam',[$exam->id]) }}" method="get">
                                                        <button type="submit" class="btn-xs btn-link white-text">Give Exam</button>
                                                    </form>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('StudentController@selectBatchForGivingExam') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-backward"></span>&thinsp;Back to Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection