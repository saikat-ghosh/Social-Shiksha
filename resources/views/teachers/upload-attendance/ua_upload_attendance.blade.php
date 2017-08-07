@extends('layouts.teacher_layouts.upload_students_attendance_layout')

    @section('menu-content')

        <div id="upload-attendance" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Upload Attendance</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action={{ action('TeacherController@saveUploadedAttendance') }} method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name ="Att_User_Id" value="{{$student->id}}">

                            <input type="hidden" name ="Att_Batch_Id" value="{{$batch->id}}">

                            <div class="form-group">
                                <label for="User_id" class="col-md-5 control-label">Student Name</label>
                                <div class="col-md-6">
                                    <input id="User_id" class="form-control" name ="Student_Name" value="{{$student->T_Stu_Name}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Subject" class="col-md-5 control-label">Subject</label>
                                <div class="col-md-6">
                                    <input id="Subject" class="form-control" name ="Subject" value="{{$batch->Batch_Subject}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Date" class="col-md-5 control-label">Date</label>
                                <div class="col-md-6">
                                    <input id="Date" class="form-control" name ="Att_Date" value="{{ $date }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Present" class="col-md-5 control-label">Present (Yes/No)</label>
                                <div class="col-md-6">
                                    <select id="Present" class="form-control" name ="Att_Present_YN" required>
                                        <option value="">--select--</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary pull-right" type="submit">
                                        Submit
                                    </button>

                                    <a class="btn btn-link" href={{ url('teacher/upload-attendance') }}> cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection