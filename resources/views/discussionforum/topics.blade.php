@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')
        <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Discuss your queries here</div>
                    <div class="panel-body">

                        <div id="post-query" class="row padding">
                            <!-- form for posting new query -->
                            <form method="POST" action="{{action('DiscussionForumTopicController@store')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="DFT_Topic">Post Your Query Here:</label>
                                    <div>
                                         <input id="DFT_Topic" type="text" class="form-control" name="DFT_Topic" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Post Query</button>
                                </div>
                            </form>
                        <div>

                        <div id="view-all-queries" class="row padding">
                            @if($topics->isEmpty())
                                <h4>No topics found!</h4>
                            @else
                                @foreach($topics as $id=>$topic)
                                    <div>
                                        <hr>
                                        <strong>{{$topic->DFT_Topic}}</strong>
                                        <span class="badge">{{ $authors[$topic->id] }}</span>
                                        <hr>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection