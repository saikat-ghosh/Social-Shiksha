@extends('layouts.student_layouts.download_study_materials_layout')

    @section('menu-content')
        <!-- Download study material -->
            <div id="select-student" class="row padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Study Materials Download</div>
                        <div class="panel-body">
                            <div>
                                @if($studyMaterials->isEmpty())
                                    <h4>No study materials found under this batch. Refine search and try again!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($studyMaterials as $studyMaterial)
                                            <li class="list-group-item padding">
                                                <strong>{{ $studyMaterial->SM_File_Name }}</strong>&nbsp;&nbsp;
                                                {{ $studyMaterial->SM_Upload_Date }}
                                                <a class="btn btn-primary pull-right" href="{{asset('storage\uploads\study-materials\\'.$studyMaterial->SM_File_Name)}}" download><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Download</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('StudentController@selectBatchForDownloadingStudyMaterials') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-backward"></span>&thinsp;Back to Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection