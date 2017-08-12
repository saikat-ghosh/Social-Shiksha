@extends('layouts.teacher_layouts.set_exams_layout')

    @section('menu-content')
        <!-- Form for uploading exam details -->
        <div id="upload-exam-details" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Set Exam</div>

                    <div class="panel-body padding">

                        @if(empty($batches))
                            <h4>You are currently not associated with any batch!</h4>
                        @else
                            <form class="form-horizontal" role="form" action="{{ action('TeacherController@saveExamDetails') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="Batch" class="col-md-4 control-label">Batch Id</label>
                                    <div class="col-md-6">
                                        <select name="EU_Batch_Id" id="Batch" class="form-control input-sm" required>
                                            <option value="">Select</option>
                                            @foreach($batches as $batch)
                                                <option value="{{$batch->id}}">{{$batch->Batch_Code}}-{{$batch->Batch_Subject}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Exam_Name" class="col-md-4 control-label">Exam name</label>
                                    <div class="col-md-6">
                                        <input id="Exam_Name" class="form-control" type="text" name ="EU_Name" placeholder="Exam name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ExamDuration" class="col-md-4 control-label">Duration of Exam (minutes)</label>
                                    <div class="col-md-6">
                                        <input id="ExamDuration" class="form-control" type="number" name ="EU_Duration" placeholder="Duration of exam" min="0" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="NoOfQuestion" class="col-md-4 control-label">Number of questions</label>
                                    <div class="col-md-6">
                                        <input id="NoOfQuestion" class="form-control" type="number" name ="EU_No_of_Q" placeholder="Number of question" min="0" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ExamInstruction" class="col-md-4 control-label">Instructions</label>
                                    <div class="col-md-6">
                                        <textarea id="ExamInstruction" class="form-control" name ="EU_Instr" placeholder="Exam instructions" rows="5" cols="15"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button class="btn btn-primary pull-right" type="submit">
                                            <span class="glyphicon glyphicon-open"></span> Upload
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection