
@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left sidebar menu goes here -->
                <ul class="list-group sidebar-list" id="sidebar">
                    <li>
                        <a  href="{{url('student/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                    </li>
                    <li>
                        <a  href="{{url('student/view-profile')}}" class="list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                    </li>
                    <li>
                        <a  href="{{url('student/batch-details')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Batches</a>
                    </li>
                    <li>
                        <a  href="{{url('student/download-study-material')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Study Material</a>
                    </li>
                    <li>
                        <a   href="{{url('student/download-test-or-practice-paper')}}" class="list-group-item sidebar-list-item"><i class="fa fa-download fa-2x"></i> Download Mock Test/Practice Paper</a>
                    </li>
                    <li>
                        <a  href="{{url('student/upload-assignment')}}" class="list-group-item sidebar-list-item"><i class="fa fa-upload fa-2x"></i> Upload Assignment</a>
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
     <!-- Batch Details for the particular student goes here -->
        <div id="view-batches" class="row padding">
            <div class="col-md-11 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Batch Details
                        <a role="button" class="btn btn-xs btn-primary pull-right xs-small-font" data-target="#join-new-batch" data-toggle="modal"><span class="xs-small-font glyphicon glyphicon-plus-sign"></span>&thinsp;Join New Batch</a>
                    </div>
                    <div class="panel-body">
                        <div>
                            @if(empty($associatedBatches))
                                <h4>You are not currently associated with any batches.</h4>
                            @else
                                <ul class="list-group striped-list">
                                    @foreach($associatedBatches as $id=>$batch)
                                        <li class="list-group-item">
                                            <strong>{{ $batch->Batch_Code }}</strong>&nbsp;&nbsp;
                                            {{ $batch->Batch_Subject }}
                                            <a class="btn btn-info btn-xs pull-right batch-delete" role="button" data-target="#confirm-batch-delete" data-toggle="modal" data-delete-link="{{ action('StudentController@removeBatch', $id) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;delete&nbsp;</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        <!-- Modal for confirming whether to Delete particular Batch -->
        <div id="confirm-batch-delete" class="modal fade" role="dialog">
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
                            <p>Sure you want to quit this batch?</p>
                            <form id="delete" action="" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
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

        <!-- Modal for joining new Batch -->
        <div id="join-new-batch" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <center>
                            <h4><span class="glyphicon glyphicon-info-sign"></span>&thinsp; Join New Batch</h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <center>
                            @if($remainingBatches->isEmpty())
                                <p>No new batches to join!</p>
                            @else
                                <form  action="{{ action('StudentController@assignBatch') }}" method="POST">
                                    {{ csrf_field() }}

                                    <label for="Batch_id">Select Batch you wish to join</label>

                                    <select id="Batch_id" class="form-control" name="Batch_Id" required>
                                        <option value="">--select--</option>
                                        @foreach($remainingBatches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->Batch_Code }}-{{ $batch->Batch_Subject }}</option>
                                        @endforeach
                                    </select>
                                    <div class="row padding">
                                        <button type="submit" class="btn btn-info">Join &thinsp;
                                            <span class="small-font glyphicon glyphicon-plus"></span>
                                        </button>
                                        <button class="btn btn-success" data-dismiss="modal">Cancel &thinsp;
                                            <span class="small-font glyphicon glyphicon-remove-circle"></span>
                                        </button>
                                    </div>
                                </form>
                            @endif
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
                    $('.batch-delete').on('click', function () {
                        $('#delete').attr('action', $(this).data('delete-link'));
                    });
                });
            </script>
        @endpush
