@extends('layouts.student_layouts.give_exams_layout')

    @section('menu-content')
        <!-- display exam details -->
        <div id="show-exam-details" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Exam Details</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action="{{ action('StudentController@startExam',[$exam->id,1]) }}" method="GET">

                            <div class="form-group">
                                <label for="Exam_Name" class="col-md-4 control-label">Exam name</label>
                                <div class="col-md-6">
                                    <input id="Exam_Name" class="form-control" type="text" name ="EU_Name" value="{{$exam->EU_Name}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ExamDuration" class="col-md-4 control-label">Duration of Exam (minutes)</label>
                                <div class="col-md-6">
                                    <input id="ExamDuration" class="form-control" type="number" name ="EU_Duration" value="{{$exam->EU_Duration}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="NoOfQuestion" class="col-md-4 control-label">Number of questions</label>
                                <div class="col-md-6">
                                    <input id="NoOfQuestion" class="form-control" type="number" name ="EU_No_of_Q" value="{{$exam->EU_No_of_Q}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ExamInstruction" class="col-md-4 control-label">Instructions</label>
                                <div class="col-md-6">
                                    <input id="ExamInstruction" class="form-control" name ="EU_Instr" value="{{$exam->EU_Instr}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        <span class="glyphicon glyphicon-time"></span> Start Exam
                                    </button>
                                    <a href="{{ action('StudentController@selectBatchForGivingExam') }}" class="xs-small-font">&thinsp;Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection