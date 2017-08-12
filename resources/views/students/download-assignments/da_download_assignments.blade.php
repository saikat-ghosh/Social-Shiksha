@extends('layouts.student_layouts.download_assignments_layout')

    @section('menu-content')
        <!-- download Mock Test Or Practice Papers -->
            <div id="select-student" class="row padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Assignments Download</div>
                        <div class="panel-body">
                            <div>
                                @if($assignments->isEmpty())
                                    <h4>No assignments found under this batch. Refine search and try again!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($assignments as $assignment)
                                            <li class="list-group-item padding">
                                                <strong>{{ $assignment->ATU_File_Name }}</strong>&nbsp;&nbsp;
                                                {{ $assignment->ATU_Upload_Date }}
                                                <a class="btn btn-primary pull-right" href="{{asset('storage\uploads\assignments\teacher-uploads\\'.$assignment->ATU_File_Name)}}" download><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Download</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('StudentController@selectBatchForDownloadingAssignments') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-backward"></span>&thinsp;Back to Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection