@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')

           <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Discuss your queries here</div>
                    <div class="panel-body">

                        <div id="post-query" class="row padding">
                            <!-- form for posting new query -->
                            <form method="POST" action="/teacher/discussion-details/{{ $id }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="DFD_Details">Post Your Question and Answers Here:</label>
                                    <div>
                                         <input id="DFD_Details" type="text" class="form-control" name="DFD_Details" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Post Query</button>
                                </div>
                            </form>
                        <div>

                        <div id="view-all-queries" class="row padding">
                            @if($discussiondetails->isEmpty())
                                <h4>No Queries found!</h4>
                            @else
                                @foreach($discussiondetails as $id=>$detail)
                                    <div>
                                        <hr>
                                        <strong>
                                            {{$detail->DFD_Details}}
                                        </strong>
                                        <span class="badge">{{ $author[$detail->id] }}</span>
                                        <span class="badge">
                                            <form action=" {{action('DiscussionForumDetailsController@destroy',$detail->id)}} " method="post">
                                            {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="delete">
                                                <button type="submit" class="btn-xs btn-link white-text">Delete</button>
                                            </form>
                                        </span>
                                        <span class="badge">
                                            <form action="/teacher/discussion-details/{{$detail->id}}/edit" method="post">
                                            {{ csrf_field() }}
                                                <button type="submit" class="btn-xs btn-link white-text">Edit</button>
                                            </form>
                                        </span>
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