@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar menu goes here -->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('/teacher/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i>Home</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/view-profile')}}" class="list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/batches')}}" class="list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Edit Batch</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-student-marks')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Student Performance Marks</a>
                </li>
                <li>
                    <a   href="{{url('/teacher/upload-attendance')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Student Attendance</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/student-performance-report')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Performance Details Report</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/student-attendance-report')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Attendance Details Report</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-study-material')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Study Material</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-test-or-practice-paper')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Mock Test/Practice Paper</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/upload-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Assignment</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/download-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Assignment</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/set-exam')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Set Exams</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/check-student-answers')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Check Student Answers</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/discussion-forum')}}" class="list-group-item sidebar-list-item"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/add-notice')}}" class="list-group-item sidebar-list-item"><i class="fa fa-plus fa-2x"></i> Add Notice</a>
                </li>
                <li>
                    <a  href="{{url('/teacher/check-notice')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> View Notice Board</a>
                </li>
            </ul>
    @endsection

    @section('menu-content')
            <!-- Form for adding new notice goes here -->
        <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Notice Board
                            <a class="pull-right" href="/teacher/dashboard"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Back to forum</a>

                    </div>
                    <div class="panel-body">
                        @foreach($notices as $notice)
                            <div><span class="badge">{{ $author[$notice->id]}}</span>
                            <p> {{ $notice->NB_Content }} </p>
                            </div>
                            @can('view',$notice)
                             <a class="xs-small-font pull-right" onclick="event.preventDefault();$('#confirm-topic-delete').modal('show')" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span>&nbsp;delete&nbsp;</a>&nbsp;
                            <a class="xs-small-font pull-right" href="add-notice/edit/{{$notice->id}}"><span class="glyphicon glyphicon-edit"></span>&nbsp;edit&nbsp;</a>
                            @endcan
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @endsection
     <!-- Modal for confirming whether to Delete Topic -->
        <div id="confirm-topic-delete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <center>
                            <h4><span class="glyphicon glyphicon-info-sign"></span>&thinsp; Message</h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <center>
                            <p><strong>Sure you want to delete this post?</strong></p>
                            <form id="topic-delete" action="/teacher/delete/{{ $notice->id }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                                <button onclick="$('#topic-delete').submit();" class="btn btn-danger" data-dismiss="modal">Yes &thinsp;
                                    <span class="small-font glyphicon glyphicon-trash"></span>
                                </button>
                                <button class="btn btn-success" data-dismiss="modal">No &thinsp;
                                    <span class="small-font glyphicon glyphicon-remove-circle"></span>
                                </button>

                        </center>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for confirming whether to Delete Comment -->
        <div id="confirm-comment-delete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <center>
                            <h4><span class="glyphicon glyphicon-info-sign"></span>&thinsp; Message</h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <center>
                            <p>Sure you want to delete this comment?</p>
                            <form id="delete" action="" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Yes &thinsp;
                                    <span class="small-font glyphicon glyphicon-trash"></span>
                                </button>
                                <button class="btn btn-success" data-dismiss="modal">No &thinsp;
                                    <span class="small-font glyphicon glyphicon-remove-circle"></span>
                                </button>
                            </form>
                        </center>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        @push('js')
            <script language="JavaScript">
                $(document).ready(function() {
                    $('.comment-delete').on('click', function () {
                        console.log($(this).data('delete-link'));
                        $('#delete').attr('action', $(this).data('delete-link'));
                    });
                });
            </script>
        @endpush