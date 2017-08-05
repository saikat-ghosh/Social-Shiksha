@extends('layouts.teacher_layouts.discussion_forum_layout')

    @section('menu-content')

        <div id="topics" class="row padding">
            <div class="col-sm-8 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Discuss your queries here
                            <a class="pull-right" href={{ action('DiscussionForumTopicController@index') }}><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Back to forum</a>

                    </div>
                    <div class="panel-body">

                        <div>
                        
                            <span class="badge"> {{ $topicAuthor }}</span>
                            @can('view',$discussionTopic)
                                <a class="xs-small-font pull-right" onclick="event.preventDefault();$('#confirm-topic-delete').modal('show')" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span>&nbsp;delete&nbsp;</a>&nbsp;
                                <a class="xs-small-font pull-right" href={{action('DiscussionForumTopicController@edit',$discussionTopic->id)}}><span class="glyphicon glyphicon-edit"></span>&nbsp;edit&nbsp;</a>
                            @endcan
                        </div>

                        <div id="view-post" class="row padding blue-box-for-posts">
                            <strong>{{ $discussionTopic->DFT_Topic }}</strong>
                        </div>

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
                                        <div>
                                             by&nbsp;<span class="badge">{{ $commentAuthors[$detail->id] }}</span>
                                            @can('view',$detail)
                                                <a class="xs-small-font pull-right comment-delete" role="button" data-target="#confirm-comment-delete" data-toggle="modal" data-delete-link="{{route('delete-comment', [$discussionTopic->id,$detail->id]) }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;delete&nbsp;</a>&nbsp;
                                                <a class="xs-small-font pull-right" href={{action('DiscussionForumDetailsController@edit',[$discussionTopic->id,$detail->id])}}><span class="glyphicon glyphicon-edit"></span>&nbsp;edit&nbsp;</a>
                                            @endcan
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div id="comment-on-post" class="row padding">
                            <!-- form for posting new comment -->
                            <form method="POST" action={{action('DiscussionForumDetailsController@store',$discussionTopic->id)}}>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

        <!-- Modal for confirming whether to Delete Topic -->
        <div id="confirm-topic-delete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <center>
                            <h4><span class="glyphicon glyphicon-info-sign"></span>&thinsp; Message</h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <center>
                            <p><strong>Sure you want to delete this post?</strong></p>
                            <form id="topic-delete" action={{action('DiscussionForumTopicController@destroy',$discussionTopic->id)}} method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                            </form>
                                <button onclick="$('#topic-delete').submit();" class="btn btn-danger" data-dismiss="modal">Yes &thinsp;
                                    <span class="small-font glyphicon glyphicon-trash"></span>
                                </button>
                                <button class="btn btn-success" data-dismiss="modal">No &thinsp;
                                    <span class="small-font glyphicon glyphicon-remove-circle"></span>
                                </button>

                        </center>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for confirming whether to Delete Comment -->
        <div id="confirm-comment-delete" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <center>
                            <h4><span class="glyphicon glyphicon-info-sign"></span>&thinsp; Message</h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <center>
                            <p>Sure you want to delete this comment?</p>
                            <form id="delete" action="" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Yes &thinsp;
                                    <span class="small-font glyphicon glyphicon-trash"></span>
                                </button>
                                <button class="btn btn-success" data-dismiss="modal">No &thinsp;
                                    <span class="small-font glyphicon glyphicon-remove-circle"></span>
                                </button>
                            </form>
                        </center>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        @push('js')
            <script language="JavaScript">
                $(document).ready(function() {
                    $('.comment-delete').on('click', function () {
                        console.log($(this).data('delete-link'));
                        $('#delete').attr('action', $(this).data('delete-link'));
                    });
                });
            </script>
        @endpush