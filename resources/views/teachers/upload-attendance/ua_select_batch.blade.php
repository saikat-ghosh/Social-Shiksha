@extends('layouts.teacher_layouts.upload_students_attendance_layout')

       @section('menu-content')

           <div id="search-student" class="row padding">
               <div class="col-md-8 col-md-offset-2">
                   <div class="panel panel-default">
                       <div class="panel panel-heading">
                           <b>Upload Attendance</b>
                       </div>

                       <div class="panel panel-body">

                           @if(empty($batches))
                               <h4>You are currently not associated with any batch!</h4>
                           @else
                            <form class="form-horizontal padding" action="{{ action('TeacherController@selectStudentForAttendanceUpload') }}" method="post">
                                {{ csrf_field() }}
                               <!-- Search by Batches -->
                                <div class="form-group">
                                    <label for="Batch_id" class="control-label">Select Batch First</label>
                                    <div>
                                        <select name="Batch_Id" id="Batch_id" class="form-control input-sm" required>
                                            <option value="">--Select--</option>
                                            @foreach($batches as $batch)
                                                <option value="{{$batch->id}}">{{$batch->Batch_Code}}-{{$batch->Batch_Subject}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                               <div class="form-group">
                                   <button type="submit" class="btn btn-primary pull-right">Search</button>
                               </div>
                            </form>
                            @endif
                       </div>
                   </div>
               </div>
           </div>

       @endsection