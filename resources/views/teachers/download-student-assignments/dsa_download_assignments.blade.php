@extends('layouts.teacher_layouts.download_student_assignment_layout')

    @section('menu-content')
        <!-- download student assignments -->
            <div id="select-student" class="row padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Assignments of <strong>{{ $student->T_Stu_Name }}</strong>
                            <a href="{{ action('TeacherController@selectBatchForDownloadingStudentAssignments') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-chevron-left"></span>&thinsp;Back</a>
                        </div>
                        <div class="panel-body">
                            <div>
                                @if($assignments->isEmpty())
                                    <h4>No assignments found!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($assignments as $assignment)
                                            <li class="list-group-item padding">
                                                <strong>{{ $assignment->ASU_File_Name }}</strong>&nbsp;&nbsp;
                                                {{ $assignment->ASU_Upload_Date }}
                                                <a class="btn btn-xs btn-info pull-right" href="{{asset('storage\uploads\assignments\student-uploads\\'.$assignment->ASU_File_Name)}}" download><span class="glyphicon glyphicon-download-alt"></span>&nbsp;Download</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection