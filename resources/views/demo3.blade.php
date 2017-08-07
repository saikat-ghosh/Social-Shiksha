@extends('layouts.teacher_layouts.teacher_profile_layout')

    @section('menu-content')

        <div id="view-profile" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile Information</div>

                    <div class="panel-body padding">


                        <form class="form-horizontal" role="form" action="#" method="POST">
                            {{csrf_field()}}


                            <div class="form-group{{$errors->has('Per_User_Id')? 'has-error' : ""}}">
                                <label for="Userid" class="col-md-4 control-label">User Id</label>
                                <div class="col-md-6">
                                    <input id="Userid"class="form-control" type="number" name ="Per_User_Id" placeholder="User Id" required>
                                    @if($errors->has('Per_User_Id'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('Per_User_Id')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="Batchid" class="col-md-4 control-label">Batch Id</label>
                                <div class="col-md-6">
                                    <select name="Per_Batch_Id" id="Batchid" class="form-control input-sm" value="Select">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="Subject" class="col-md-4 control-label">Subject</label>
                                <div class="col-md-6">
                                    <input id="Subject"class="form-control" type="text" name ="Per_Subject" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="Marks" class="col-md-4 control-label">Marks</label>
                                <div class="col-md-6">
                                    <input id="Marks"class="form-control" type="number" name ="Per_Marks" required min="0">
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="TotMarks" class="col-md-4 control-label"> Total Marks</label>
                                <div class="col-md-6">
                                    <input id="TotMarks"class="form-control" type="number" name ="Per_Tot_Marks" min="0" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit">
                                        Submit
                                    </button>

                                    <a class="btn btn-link" href="#"> cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <div>
        </div>

@endsection
