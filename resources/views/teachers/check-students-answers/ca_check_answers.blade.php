@extends('layouts.teacher_layouts.check_students_answers_layout')

    @section('menu-content')
        <!-- check student marks here -->
        <div id="check-answers" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Check Answers</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action="{{ action('TeacherController@saveObtainedMarks',[$answer->ER_EU_Id,$answer->ER_User_Id]) }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="totalSubmittedAnswers" value={{ $totalSubmittedAnswers }}>

                            <input type="hidden" name="question_no" value="{{ $question_no }}">

                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">

                            <input type="hidden" name="totalMarks" value="{{ $totalMarks }}">

                            <input type="hidden" name="obtainedMarks" value="{{ $obtainedMarks }}">

                            <div class="form-group">
                                <label for="EQuestion" class="col-md-4 control-label">Question</label>
                                <div class="col-md-6">
                                    <input id="EQuestion" class="form-control" type="text" name ="EQ_Q" value="{{ $question->EQ_Q }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="EQtype" class="col-md-4 control-label">Question Type</label>
                                <div class="col-md-6">
                                    <input id="EQtype" class="form-control" type="text" name ="EQ_Q_Type" value="{{ $question->EQ_Q_Type }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="EQAns" class="col-md-4 control-label">Original Answer</label>
                                <div class="col-md-6">
                                    <input id="EQAns" class="form-control" type="text" name ="EQ_Ans" value="{{ $question->EQ_Ans }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="StuAns" class="col-md-4 control-label">Student's Answer</label>
                                <div class="col-md-6">
                                    <input id="StuAns" class="form-control" type="text" name ="ER_Ans" value="{{ $answer->ER_Ans }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="EQmarks" class="col-md-4 control-label">Allotted Marks</label>
                                <div class="col-md-6">
                                    <input id="EQmarks" class="form-control" name ="Marks" value={{ $question->Marks }} readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ObtMarks" class="col-md-4 control-label">Obtained Marks</label>
                                <div class="col-md-6">
                                    <input id="ObtMarks" class="form-control" type="number" max="{{ $question->Marks }}" name ="ER_Marks_Obt" placeholder="Enter Marks" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button class="btn btn-primary pull-right" type="submit">Save & Next<span class="glyphicon glyphicon-chevron-right"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
