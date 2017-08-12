@extends('layouts.teacher_layouts.check_students_answers_layout')

@section('menu-content')

        <!-- Form for uploading student marks goes here -->
        <div id="upload-student-marks" class="row padding">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                        <b>Student Performance Details</b>
                    </div>

                    <div class="panel panel-body">

                        <form class="form-horizontal" role="form" action="{{action('TeacherController@uploadStudentPerformance',[$examDetails->id,$student->id])}}" method="POST">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="User_id" class="col-md-5 control-label">Student Name</label>
                                <div class="col-md-6">
                                    <input id="User_id" class="form-control" name ="Student_Name" value="{{$student->T_Stu_Name}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Subject" class="col-md-5 control-label">Exam Name</label>
                                <div class="col-md-6">
                                    <input id="Subject" class="form-control" name ="Exam_Name" value="{{$examDetails->EU_Name}}" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="Marks" class="col-md-5 control-label">Marks obtained</label>
                                <div class="col-md-6">
                                    <input id="Marks" class="form-control" type="number" name ="Per_Marks" value={{ $obtainedMarks }} readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="TotMarks" class="col-md-5 control-label"> Total Marks</label>
                                <div class="col-md-6">
                                    <input id="TotMarks" class="form-control" type="number" name ="Per_Tot_Marks" value={{ $totalMarks }} readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        Upload Marks
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection

