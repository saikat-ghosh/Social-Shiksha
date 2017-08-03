@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')
        <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit your post</div>
                    <div class="panel-body">

                        <div id="edit-query" class="row padding">
                            <!-- form for editing existing query -->
                            <form action={{action('DiscussionForumTopicController@update',$topic->id)}} method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="DFT_Topic">Edit your query</label>
                                    <div>
                                         <input id="DFT_Topic" type="text" class="form-control" name="DFT_Topic" value="{{ $topic->DFT_Topic }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>

                                    <a class="btn btn-link" href="{{ route('post-detail',$topic->id) }}">Cancel</a>
                                </div>
                            </form>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    @endsection