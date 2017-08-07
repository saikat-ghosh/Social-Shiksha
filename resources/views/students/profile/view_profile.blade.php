@extends('layouts.student_layouts.student_profile_layout')

    @section('menu-content')

            <!-- Student's profile information goes here -->
            <div id="view-profile" class="row padding">
                <div class="col-sm-11 col-sm-offset-1 no-padding">
                    <div class="panel panel-default">
                        <div class="panel-heading">Profile Information</div>

                        <div class="panel-body padding">

                            <div class="col-sm-4">
                                <!-- Displays Profile Picture -->
                                @if(is_null($student->T_Stu_File_Name) || !file_exists(storage_path('app\public\uploads\avatars\students\\'.$student->T_Stu_File_Name)))
                                    <img class="img-responsive profile-avatar pull-right"  src={{asset('images\no-profile-pic.png')}}>
                                @else
                                    <img class="img-responsive profile-avatar pull-right"  src={{asset('storage\uploads\avatars\students\\'.$student->T_Stu_File_Name)}}>
                                @endif
                            </div>

                            <form class="form-horizontal col-sm-8" role="form" action="{{ action('StudentController@edit_profile') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-md-5 control-label" for="name">Name </label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="Inst_Name" value="{{ $student->T_Stu_Name }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-5 control-label">Email </label>

                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="Inst_Email" value="{{ $student->T_Stu_Email }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="col-md-5 control-label">Mobile </label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="Inst_No" value="{{ $student->T_Stu_No }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-md-5 control-label">Address</label>

                                    <div class="col-md-6">
                                        <input id="address" type="text" class="form-control" name="Inst_Addr" value="{{ $student->T_Stu_Addr }}" placeholder="Enter Address" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="col-md-5 control-label">Username </label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="Inst_User_Id" value="{{ $student->T_Stu_User_Id }}" disabled>
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