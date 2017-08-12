@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar menu goes here -->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('student/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                </li>
                <li>
                    <a  href="{{url('student/view-profile')}}" class="list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                </li>
                <li>
                    <a  href="{{url('student/batch-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Batches</a>
                </li>
                <li>
                    <a  href="{{url('student/download-study-material')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Study Material</a>
                </li>
                <li>
                    <a   href="{{url('student/download-test-or-practice-paper')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Mock Test/Practice Paper</a>
                </li>
                <li>
                    <a  href="{{url('student/upload-assignment')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Assignment</a>
                </li>
                <li>
                    <a  href="{{url('student/download-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Assignment</a>
                </li>
                <li>
                    <a  href="{{url('student/give-exam')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Give Exams</a>
                </li>
                <li>
                    <a  href="{{url('student/discussion-forum')}}" class="list-group-item sidebar-list-item"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                </li>
                <li>
                    <a  href="{{url('student/notice-board')}}" class="list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                </li>
            </ul>
    @endsection

       @section('menu-content')

           <div id="upload-assignment" class="row padding">
               <div class="col-md-8 col-md-offset-2">
                   <div class="panel panel-default">
                       <div class="panel panel-heading">
                           <b>Upload Assignment</b>
                       </div>

                       <div class="panel panel-body">

                           @if(empty($batches))
                               <h4>You are currently not associated with any batch!</h4>
                           @else
                               <form class="form-horizontal padding" enctype="multipart/form-data" role="form" action="{{ action('StudentController@saveUploadedAssignment') }}" method="POST">
                                   {{ csrf_field() }}

                                   <!-- Upload Assignment Here -->
                                   <input type="hidden" name ="ASU_User_Id" value="{{$student->id}}">

                                    <div class="form-group">
                                        <label for="Batch_id" class="control-label">Select Batch</label>
                                        <div>
                                            <select id="Batch_id" name="ASU_Batch_Id" class="form-control input-sm" required>
                                                <option value="">--Select--</option>
                                                @foreach($batches as $batch)
                                                    <option value="{{$batch->id}}">{{$batch->Batch_Code}}-{{$batch->Batch_Subject}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="File_Upload" class="control-label">Drop Assignment Here</label>
                                        <div>
                                            <input id="File_Upload" type="file" name="File_Name" class="input-sm" required>
                                        </div>
                                    </div>

                                   <div class="form-group">
                                       <button type="submit" class="btn btn-primary pull-right">Upload</button>
                                   </div>
                            </form>

                            <hr>

                            <div>
                                   @if($uploadedFiles->isEmpty())
                                       <h4>You have not uploaded any assignments yet.</h4>
                                   @else
                                       <h4><b>Uploaded Assignments</b></h4>
                                       <ul class="list-group striped-list">
                                           @foreach($uploadedFiles as $file)
                                               <li class="list-group-item">
                                                   <strong>{{ $file->ASU_File_Name }}</strong>&nbsp;&nbsp;
                                                   {{ $file->ASU_Subject }}&nbsp;&nbsp;
                                                   {{ $file->ASU_Upload_Date }}
                                                   <a href="{{ action('TeacherController@deleteUploadedAssignment',$file->id) }}" data-toggle="tooltip" title="Delete" class="xs-small-font pull-right"
                                                      onclick="event.preventDefault();
                                                             document.getElementById('delete-assignment-form').submit();">
                                                       <span class="glyphicon glyphicon-trash"></span>
                                                   </a>
                                                   <!-- Submit this form to delete assignment -->
                                                   <form id="delete-assignment-form" action="{{ action('StudentController@deleteUploadedAssignment',$file->id) }}" method="POST" style="display: none;">
                                                       {{ csrf_field() }}
                                                       {{ method_field('DELETE') }}
                                                   </form>
                                               </li>
                                           @endforeach
                                       </ul>
                                   @endif
                               </div>

                           @endif
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