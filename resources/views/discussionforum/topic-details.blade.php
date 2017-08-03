@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')

           <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Discuss your queries here</div>
                    <div class="panel-body">

                        <div id="view-post" class="row padding blue-box-for-posts">
                            <strong>{{ $discussionTopic->DFT_Topic }}</strong>
                        </div>

                        <div id="comment-on-post" class="row padding">
                            <!-- form for posting new query -->
                            <form method="POST" action="/teacher/discussion-details/{{ $id }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="DFD_Details">Leave Your Comments below :</label>
                                    <div>
                                         <input id="DFD_Details" type="text" class="form-control" name="DFD_Details" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Post</button>
                                </div>
                            </form>
                        <div>

                        <div id="view-all-comments" class="row padding">
                            @if($discussionDetails->isEmpty())
                                <h4>No Comments found!</h4>
                            @else
                                @foreach($discussionDetails as $id=>$detail)
                                    <div>
                                        <hr>
                                        <strong>
                                            {{$detail->DFD_Details}}
                                        </strong>
                                        <span class="badge">{{ $author[$detail->id] }}</span>
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