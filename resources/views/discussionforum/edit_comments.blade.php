@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')
        <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Discuss your queries here</div>
                    <div class="panel-body">

                        <div id="post-query" class="row padding">
                            <!-- form for posting new query -->
                            <form action={{ action('DiscussionForumDetailsController@update',[$topic_id,$comment->id]) }} method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="DFD_Details">Edit your query</label>
                                    <div>
                                         <input id="DFD_Details" type="text" class="form-control" name="DFD_Details" value="{{ $comment->DFD_Details }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>

                                    <a class="btn btn-link" href="{{ route('post-detail',$topic_id) }}">Cancel</a>
                                </div>
                            </form>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    @endsection