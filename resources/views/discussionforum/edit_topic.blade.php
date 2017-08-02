@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')
        <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Discuss your queries here</div>
                    <div class="panel-body">

                        <div id="post-query" class="row padding">
                            <!-- form for posting new query -->
                            <form action="/teacher/discussion-forum/{{$topic->id}}/update" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">

                                    <label for="DFT_Topic">Edit your query</label>
                                    <div>
                                         <input id="DFT_Topic" type="text" class="form-control" name="DFT_Topic" placeholder="{{ $topic->DFT_Topic }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary pull-right">Post Query</button>
                                </div>
                            </form>
                        <div>
                    </div>
                </div>
            </div>
        </div>
    @endsection