@extends('layouts.teacher_layouts.set_exams_layout')

    @section('menu-content')
        <!-- Form for uploading exam questions -->
        <div id="upload-exam-questions" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload Question {{ $question_no }}</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action="{{ action('TeacherController@saveExamQuestions') }}" method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="EQ_EU_Id" value={{ $examDetails->id }}>

                            <div class="form-group">
                                <label for="ExamName" class="col-md-4 control-label">Exam Name</label>
                                <div class="col-md-6">
                                    <input id="ExamName" class="form-control" type="text" name ="ExamName" value="{{ $examDetails->EU_Name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="NoOfQuestions" class="col-md-4 control-label">Total Questions</label>
                                <div class="col-md-6">
                                    <input id="NoOfQuestions" class="form-control" type="number" name ="EQ_No_of_Q" value="{{ $examDetails->EU_No_of_Q }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="QuestionNo" class="col-md-4 control-label">Question No.</label>
                                <div class="col-md-6">
                                    <input id="QuestionNo" class="form-control" type="number" name ="EQ_Q_Number" value="{{ $question_no }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="EQuestion" class="col-md-4 control-label">Question</label>
                                <div class="col-md-6">
                                    <input id="EQuestion" class="form-control" type="text" name ="EQ_Q" placeholder="Enter Question" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="EQtype" class="col-md-4 control-label">Question Type</label>
                                <div class="col-md-6">
                                    <select onchange ="show()" name="EQ_Q_Type" id="EQtype" class="form-control input-sm" required>
                                        <option value="">Select</option>
                                        <option value="MCQ">MCQ</option>
                                        <option value="Subjective">Subjective</option>
                                    </select>
                                </div>
                            </div>



                            <div id="Options" style="display:none">

                                <div class="form-group">
                                    <label for="Eoption1" class="col-md-4 control-label">Option 1</label>
                                    <div class="col-md-6">
                                        <input id="Eoption1" class="form-control" type="text" name ="EQ_Op1" placeholder="Enter Option 1">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="Eoption2" class="col-md-4 control-label">Option 2</label>
                                    <div class="col-md-6">
                                        <input id="Eoption2"class="form-control" type="text" name ="EQ_Op2" placeholder="Enter Option 2">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="Eoption3" class="col-md-4 control-label">Option 3</label>
                                    <div class="col-md-6">
                                        <input id="Eoption3"class="form-control" type="text" name ="EQ_Op3" placeholder="Enter Option 3">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="Eoption4" class="col-md-4 control-label">Option 4</label>
                                    <div class="col-md-6">
                                        <input id="Eoption4" class="form-control" type="text" name ="EQ_Op4" placeholder="Enter Option 4">
                                    </div>
                                </div>
                            </div>


                            <div id="subjective_Ans" style="display: none">
                                <div class="form-group">
                                    <label for="EQans" class="col-md-4 control-label">Answer</label>
                                    <div class="col-md-6">
                                        <input id="EQans" class="form-control" type="text" name ="EQ_Ans" placeholder="Enter Answer" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="EQmarks" class="col-md-4 control-label">Marks</label>
                                    <div class="col-md-6">
                                        <input id="EQmarks" class="form-control" type="number" name ="Marks" placeholder="Enter marks" min="0" required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        Submit
                                    </button>

                                    <a class="btn btn-link" href="#">Abort Test</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('js')
        <script>
            function show()
            {
                if($("#EQtype").val()=="MCQ"){

                    $("#Options").css("display", "inline");

                    $("#subjective_Ans").css("display", "inline");
                }

                else if($("#EQtype").val()=="Subjective"){

                    $("#Options").css("display", "none");

                    $("#subjective_Ans").css("display", "inline");
                }
            }
        </script>
    @endpush