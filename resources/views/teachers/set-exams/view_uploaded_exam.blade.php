@extends('layouts.teacher_layouts.set_exams_layout')

    @section('menu-content')
        <!-- view uploaded exam with questions -->
        <div id="view-uploaded-exam" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">View Uploaded Exam</div>

                    <div class="panel-body padding">
                        <!-- display uploaded exam -->
                        <div id="exam-details" class="row">
                            <div class="padding-side">
                                <strong>Exam Name .</strong>&nbsp;&nbsp;{{ $examDetails->EU_Name }}
                                <a class="xs-small-font pull-right" data-toggle="tooltip" title="Delete" href=""><span class="glyphicon glyphicon-trash"></span></a>
                            </div>
                        </div>

                        <div class="row" id="uploaded-questions">
                            @foreach($examQuestions as $question)
                                <hr>
                                <div class="padding-side">
                                    <strong>Question {{$question_no++}}.</strong>&nbsp;&nbsp;{{ $question->EQ_Q }}
                                    <a class="xs-small-font pull-right" data-toggle="tooltip" title="Edit" href=""><span class="glyphicon glyphicon-pencil"></span></a>
                                </div>
                            @endforeach
                        </div>

                        <div class="row padding">
                            <a class="btn btn-primary pull-right" href="{{ action('TeacherController@uploadExamDetails') }}">Done</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush

