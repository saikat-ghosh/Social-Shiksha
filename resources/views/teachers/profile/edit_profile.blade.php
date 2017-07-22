@extends('layouts.institution_layouts.profile_layout')

    @section('menu-content')

        <!-- Form for editing Teacher's profile goes here -->
        <div id="edit-profile" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile Information</div>

                    <div class="panel-body padding">
                        <div class="col-sm-4">
                        <!-- Displays Profile Picture -->
                            <div class="avatar-container">
                                @if(is_null($teacher->T_Stu_File_Name) ||!file_exists(public_path('uploads\avatars\teachers\\'.$teacher->T_Stu_File_Name)))
                                    <img class="img-responsive profile-avatar pull-right"  src={{asset('images\no-profile-pic.png')}}>
                                @else
                                    <img class="img-responsive profile-avatar pull-right"  src={{asset('uploads\avatars\teachers\\'.$teacher->T_Stu_File_Name)}}>
                                @endif
                            </div>
                            <div class="padding">
                                <!-- Change Picture Link -->
                                <a class="xs-small-font pull-right" href="" id="upload_link"><span class="glyphicon glyphicon-pencil"></span> Change Picture</a>
                            </div>
                    </div>

                    <!-- Displays Profile Information -->
                    <form class="form-horizontal col-sm-8" enctype="multipart/form-data" role="form" action="{{ action('TeacherController@update_profile') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('T_Stu_Name') ? ' has-error' : '' }}">
                                    <label class="col-md-5 control-label" for="name">Name * </label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="T_Stu_Name" value="{{ $teacher->T_Stu_Name }}" required autofocus>

                                        @if ($errors->has('T_Stu_Name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('T_Stu_Name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('T_Stu_Email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-5 control-label">Email *</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="T_Stu_Email" value="{{ $teacher->T_Stu_Email }}" required>

                                        @if ($errors->has('T_Stu_Email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('T_Stu_Email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('T_Stu_No') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-5 control-label">Mobile *</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="T_Stu_No" value="{{ $teacher->T_Stu_No }}" required>

                                        @if ($errors->has('T_Stu_No'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('T_Stu_No') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('T_Stu_Addr') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-5 control-label">Address</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="T_Stu_Addr" value="{{ $teacher->T_Stu_Addr }}">

                                        @if ($errors->has('T_Stu_Addr'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('T_Stu_Addr') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('T_Stu_User_Id') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-5 control-label">Username *</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="T_Stu_User_Id" value="{{ $teacher->T_Stu_User_Id }}" required>

                                        @if ($errors->has('T_Stu_User_Id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('T_Stu_User_Id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <input id="upload" type="file" name="profile-avatar"/>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-info pull-right">Update</button>

                                        <a class="btn btn-link" href="{{ action('TeacherController@view_profile') }}">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of content -->

    @endsection

    @push('css')
        #upload_link{
        text-decoration:none;
        }
        #upload{
        display:none
        }
    @endpush

    @push('js')
        <script>
            $(function(){
                $("#upload_link").on('click', function(e){
                    e.preventDefault();
                    $("#upload:hidden").trigger('click');
                });
            });
        </script>
    @endpush