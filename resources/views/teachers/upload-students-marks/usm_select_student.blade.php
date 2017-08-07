@extends('layouts.teacher_layouts.upload_students_marks_layout')

    @section('menu-content')
        <!-- Select students for marks upload -->
            <div id="select-student" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Select Student for Marks Upload</div>
                        <div class="panel-body">
                            <div>
                                @if(empty($students))
                                    <h4>No students found against your search. Refine search and try again!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($students as $id=>$student)
                                            <li class="list-group-item">
                                                <strong>{{ $student->T_Stu_Name }}</strong>&nbsp;&nbsp;
                                                {{ $student->T_Stu_No }}
                                                <span class="badge">
                                                    <form action="{{ action('TeacherController@uploadMarks',[$batch_id,$student->id]) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn-xs btn-link white-text">Upload</button>
                                                    </form>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('TeacherController@selectBatchForMarksUpload') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-backward"></span>&thinsp;Back to Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection