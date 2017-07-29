@extends('layouts.institution_layouts.institution_profile_layout')

    @section('menu-content')

        <!-- Form for editing Institution's profile goes here -->
            <div id="edit-profile" class="row padding">
                <div class="col-sm-11 col-sm-offset-1 no-padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Profile Information</div>

                        <div class="panel-body padding">
                            <div class="col-sm-4">
                                <!-- Displays Profile Picture -->
                                <div class="avatar-container">
                                    @if(is_null($institute->Inst_File_Name) || !file_exists(storage_path('app\public\uploads\avatars\institutions\\'.$institute->Inst_File_Name)))
                                        <img class="img-responsive profile-avatar pull-right"  src={{asset('images\no-profile-pic.png')}}>
                                    @else
                                        <img class="img-responsive profile-avatar pull-right"  src={{asset('storage\uploads\avatars\institutions\\'.$institute->Inst_File_Name)}}>
                                    @endif
                                </div>
                                <div class="padding">
                                    <!-- Change Picture Link -->
                                    <a class="xs-small-font pull-right" href="" id="upload_link"><span class="glyphicon glyphicon-pencil"></span> Change Picture</a>
                                </div>
                            </div>

                            <!-- Displays Profile Information -->
                            <form class="form-horizontal col-sm-8" enctype="multipart/form-data" role="form" action="{{ action('InstitutionController@update_profile') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('Inst_Name') ? ' has-error' : '' }}">
                                    <label class="col-md-5 control-label" for="name">Name * </label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="Inst_Name" value="{{ $institute->Inst_Name }}" required autofocus>

                                        @if ($errors->has('Inst_Name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_Name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Inst_Email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-5 control-label">Email *</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="Inst_Email" value="{{ $institute->Inst_Email }}" required>

                                        @if ($errors->has('Inst_Email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_Email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Inst_No') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-5 control-label">Mobile *</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="Inst_No" value="{{ $institute->Inst_No }}" required>

                                        @if ($errors->has('Inst_No'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_No') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Inst_Addr') ? ' has-error' : '' }}">
                                    <label for="address" class="col-md-5 control-label">Address</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="Inst_Addr" value="{{ $institute->Inst_Addr }}">

                                        @if ($errors->has('Inst_Addr'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_Addr') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Inst_User_Id') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-5 control-label">Username *</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="Inst_User_Id" value="{{ $institute->Inst_User_Id }}" required>

                                        @if ($errors->has('Inst_User_Id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_User_Id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Inst_Exam_Type') ? ' has-error' : '' }}">
                                    <label for="exam_type" class="col-md-5 control-label">Exam Type</label>

                                    <div class="col-md-6">
                                        <input id="exam_type" type="text" class="form-control" name="Inst_Exam_Type" value="{{ $institute->Inst_Exam_Type }}">

                                        @if ($errors->has('Inst_Exam_Type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_Exam_Type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('Inst_Fee_Paid_YN') ? ' has-error' : '' }}">
                                    <label for="fees" class="col-md-5 control-label">Fees Paid? *</label>

                                    <div class="col-md-6">
                                        <select id="fees" class="form-control" name="Inst_Fee_Paid_YN" required>
                                            <option value="Y" {{ $institute->Inst_Fee_Paid_YN == 'Y' ? 'selected="selected"' : '' }}>YES</option>
                                            <option value="N" {{ $institute->Inst_Fee_Paid_YN == 'N' ? 'selected="selected"' : '' }}>No</option>
                                        </select>

                                        @if ($errors->has('Inst_Fee_Paid_YN'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Inst_Fee_Paid_YN') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <input id="upload" type="file" name="profile-avatar"/>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-info pull-right">Update</button>

                                        <a class="btn btn-link" href="{{ action('InstitutionController@view_profile') }}">Cancel</a>
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