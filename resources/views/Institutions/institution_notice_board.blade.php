@extends('layouts.dashboard-layout')

    @section('sidebar-menu-left')

        <!-- Left Sidebar Menu goes here-->
            <ul class="list-group sidebar-list" id="sidebar">
                <li>
                    <a  href="{{url('institution/dashboard')}}" class="list-group-item sidebar-list-item"><i class="fa fa-home fa-2x"></i> Home</a>
                </li>
                <li>
                    <a  href="{{url('institution/view-profile')}}" class="list-group-item sidebar-list-item"><i class="fa fa-user fa-2x"></i> Profile</a>
                </li>
                <li>
                    <a  href="{{url('institution/batch-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-edit fa-2x"></i> Batches</a>
                </li>
                <li>
                    <a  href="{{url('institution/teacher-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Teacher Details</a>
                </li>
                <li  >
                    <a  href="{{url('institution/student-details')}}" class="list-group-item sidebar-list-item"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details</a>
                </li>
                <li>
                    <a  href="{{url('institution/notice-board')}}" class="active list-group-item sidebar-list-item"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                </li>
            </ul>

    @endsection

    @section('menu-content')
        <!-- Institution notice-board goes here -->
            <div id="check-notice" class="row padding">
                <div class="col-sm-8 col-sm-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Notice Board</div>
                        <div class="panel-body">
                            @if($notices->isEmpty())
                                <h4>No notices to display.</h4>
                            @else
                                @foreach($notices as $notice)
                                    <div>
                                        <!-- Notice Heading -->
                                        <strong>{{ $notice->NB_Heading }}</strong>
                                        <!-- Author's name -->
                                        <span class="badge">{{ $authors[$notice->id]}}</span>
                                    </div>
                                    <!-- Notice body -->
                                    <div>
                                        <p> {{ $notice->NB_Content }} </p>
                                    </div>
                                    <hr>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

    @endsection