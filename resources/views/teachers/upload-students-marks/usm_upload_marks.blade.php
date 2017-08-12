@extends('layouts.teacher_layouts.upload_students_marks_layout')

    @section('menu-content')

            <!-- Form for uploading student marks goes here -->
                <div id="upload-student-marks" class="row padding">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel panel-heading">
                                <b>Students' Marks Upload</b>
                            </div>

                            <div class="panel panel-body">

                                <form class="form-horizontal" role="form" action="{{action('TeacherController@saveUploadedMarks')}}" method="POST">
                                    {{csrf_field()}}

                                    <input type="hidden" name ="Per_User_Id" value="{{$student->id}}">

                                    <input type="hidden" name ="Per_Batch_Id" value="{{$batch->id}}">

                                    <div class="form-group">
                                        <label for="User_id" class="col-md-5 control-label">Student Name</label>
                                        <div class="col-md-6">
                                            <input id="User_id" class="form-control" name ="Student_Name" value="{{$student->T_Stu_Name}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Subject" class="col-md-5 control-label">Subject</label>
                                        <div class="col-md-6">
                                            <input id="Subject" class="form-control" name ="Per_Subject" value="{{$batch->Batch_Subject}}" readonly>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="Marks" class="col-md-5 control-label">Marks obtained</label>
                                        <div class="col-md-6">
                                            <input id="Marks" class="form-control" type="number" name ="Per_Marks" required min="0">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="TotMarks" class="col-md-5 control-label"> Total Marks</label>
                                        <div class="col-md-6">
                                            <input id="TotMarks" class="form-control" type="number" name ="Per_Tot_Marks" min="0" required>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-3">
                                            <button class="btn btn-primary pull-right" type="submit">
                                                Save
                                            </button>

                                            <a class="btn btn-link" href="{{ url('teacher/upload-student-marks') }}"> cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

    @endsection

