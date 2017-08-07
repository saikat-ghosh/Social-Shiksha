@extends('layouts.institution_layouts.institution_profile_layout')

    @section('menu-content')
 
            <!-- Institution's profile information goes here -->
            <div id="view-profile" class="row padding">
                <div class="col-sm-11 col-sm-offset-1 no-padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Profile Information</div>

                        <div class="panel-body padding">

                            <div class="col-sm-4">
                                <!-- Displays Profile Picture -->
                                @if(is_null($institute->Inst_File_Name) || !(file_exists(storage_path('app\public\uploads\avatars\institutions\\'.$institute->Inst_File_Name))))
                                    <img class="img-responsive profile-avatar pull-right" alt="no-pic" src={{asset('images\no-profile-pic.png')}}>
                                @else
                                    <img class="img-responsive profile-avatar pull-right" alt="pic" src={{asset('storage\uploads\avatars\institutions\\'.$institute->Inst_File_Name)}}>
                                @endif
                            </div>


                            <form class="form-horizontal col-sm-8" role="form" action="{{ action('InstitutionController@edit_profile') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-md-5 control-label" for="name">Name * </label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="Inst_Name" value="{{ $institute->Inst_Name }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-5 control-label">Email *</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="Inst_Email" value="{{ $institute->Inst_Email }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-5 control-label">Mobile *</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="Inst_No" value="{{ $institute->Inst_No }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-md-5 control-label">Address</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="Inst_Addr" value="{{ $institute->Inst_Addr }}" placeholder="Enter Address" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-md-5 control-label">Username *</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="Inst_User_Id" value="{{ $institute->Inst_User_Id }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exam_type" class="col-md-5 control-label">Exam Type</label>

                                    <div class="col-md-6">
                                        <input id="exam_type" type="text" class="form-control" name="Inst_Exam_Type" value="{{ $institute->Inst_Exam_Type }}" placeholder="Enter Exam Type" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="fees" class="col-md-5 control-label">Fees Paid *</label>

                                    <div class="col-md-6">
                                        <select id="fees" class="form-control" name="Inst_Fee_Paid_YN" disabled>
                                            <option value="Y" {{ $institute->Inst_Fee_Paid_YN == 'Y' ? 'selected="selected"' : '' }}>YES</option>
                                            <option value="N" {{ $institute->Inst_Fee_Paid_YN == 'N' ? 'selected="selected"' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary pull-right">Edit Profile </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of content -->

    @endsection