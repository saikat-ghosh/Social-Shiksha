@extends('layouts.student_layouts.download_mock_test_or_practice_papers_layout')

    @section('menu-content')
        <!-- download Mock Test Or Practice Papers -->
            <div id="select-student" class="row padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Mock Test / Practice Papers Download</div>
                        <div class="panel-body">
                            <div>
                                @if($mockTestOrPracticePapers->isEmpty())
                                    <h4>No mock test or practice papers found under this batch. Refine search and try again!</h4>
                                @else
                                    <ul class="list-group striped-list">
                                        @foreach($mockTestOrPracticePapers as $mockTestOrPracticePaper)
                                            <li class="list-group-item padding">
                                                <strong>{{ $mockTestOrPracticePaper->MT_File_Name }}</strong>&nbsp;&nbsp;
                                                {{ $mockTestOrPracticePaper->MT_Upload_Date }}
                                                <a class="btn btn-primary pull-right" href="{{asset('storage\uploads\mock-test-OR-practice-papers\\'.$mockTestOrPracticePaper->MT_File_Name)}}" download><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Download</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div>
                                <a href="{{ action('StudentController@selectBatchForDownloadingMockTestOrPracticePapers') }}" class="pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-backward"></span>&thinsp;Back to Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection