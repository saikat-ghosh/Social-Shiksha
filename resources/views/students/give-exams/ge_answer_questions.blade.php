@extends('layouts.student_layouts.give_exams_layout')

    @section('menu-content')
        <!-- display question -->
        <div id="show-question" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Answer Question {{ $question->EQ_Q_Number }}</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action="{{ action('StudentController@saveStudentResponse',[$exam_id,$question_no+1]) }}" method="POST">
                            {{csrf_field()}}

                            <input type="hidden" name="ER_EU_Id" value="{{ $exam_id }}">

                            <input type="hidden" name="ER_EQ_Id" value="{{ $question->id }}">

                            <input type="hidden" name="total_questions" value="{{ $question->EQ_No_of_Q }}">

                            <div class="form-group">
                                <label for="Question" class="col-md-4 control-label">Question :</label>
                                <div class="col-md-6">
                                    <input id="Question" class="form-control" type="text" name ="ER_Q" value="{{ $question->EQ_Q }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="QuestionType" class="col-md-4 control-label">Type :</label>
                                <div class="col-md-6">
                                    <input id="QuestionType" class="form-control" type="text" name ="ER_Q_Type" value="{{ $question->EQ_Q_Type }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="QuestionMarks" class="col-md-4 control-label">Marks Allotted :</label>
                                <div class="col-md-6">
                                    <input id="QuestionMarks" class="form-control" type="text"  name="ER_Max_Marks" value="{{ $question->Marks }}" readonly>
                                </div>
                            </div>

                            @if($question->EQ_Q_Type == 'MCQ')
                                <div class="form-group">
                                    <label for="answer" class="col-md-4 control-label">Answer :</label>
                                    <div class="col-md-6">
                                        @if(!empty($question->EQ_Op1))
                                            <div class="radio">
                                                <label><input type="radio" name="ER_Ans" value="{{ $question->EQ_Op1 }}" required>{{ $question->EQ_Op1 }}</label>
                                            </div>
                                        @endif
                                        @if(!empty($question->EQ_Op2))
                                            <div class="radio">
                                                <label><input type="radio" name="ER_Ans" value="{{ $question->EQ_Op2 }}">{{ $question->EQ_Op2 }}</label>
                                            </div>
                                        @endif
                                        @if(!empty($question->EQ_Op3))
                                            <div class="radio">
                                                <label><input type="radio" name="ER_Ans" value="{{ $question->EQ_Op3 }}">{{ $question->EQ_Op3 }}</label>
                                            </div>
                                        @endif
                                        @if(!empty($question->EQ_Op4))
                                            <div class="radio">
                                                <label><input type="radio" name="ER_Ans" value="{{ $question->EQ_Op4 }}">{{ $question->EQ_Op4 }}</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="answer" class="col-md-4 control-label">Answer :</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="5" id="answer" name="ER_Ans" required></textarea>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        <span class="glyphicon glyphicon-save"></span> Save Response
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection