@extends('layouts.institution_layouts.batch_details_layout')

    @section('menu-content')

            <!-- Institution's Batch details goes here -->

            <div id="view-batches" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Ongoing Batches</div>
                            <div class="panel-body">
                                <div>
                                    @if($batches->isEmpty())
                                        <h4>No ongoing batches now.</h4>
                                    @else
                                        <ul class="list-group striped-list">
                                            @foreach($batches as $batch)
                                                <li class="list-group-item">
                                                    <strong>{{ $batch->Batch_Code }}</strong>&nbsp;&nbsp;
                                                    {{ $batch->Batch_Subject }}
                                                    <span class="badge">
                                                        <form action="{{ action('BatchController@destroy',$batch->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="delete">
                                                            <button type="submit" class="btn-xs btn-link white-text">Delete</button>
                                                        </form>
                                                    </span>
                                                    <span class="badge">
                                                        <form action="{{ action('BatchController@edit',$batch->id) }}" method="get">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="btn-xs btn-link white-text">Edit</button>
                                                        </form>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ action('BatchController@create') }}" class="btn btn-info pull-right xs-small-font"><span class="xs-small-font glyphicon glyphicon-plus-sign"></span>&thinsp;Add New</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

    @endsection

