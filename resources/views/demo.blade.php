@extends('layouts.teacher_layouts.teacher_profile_layout')

    @section('menu-content')

        <div id="view-profile" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile Information</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action="#" method="POST">
                            {{csrf_field()}}


                            <div class="form-group{{$errors->has('Att_User_Id')? 'has-error' : ""}}">
                                <label for="Userid" class="col-md-4 control-label">User Id</label>
                                <div class="col-md-6">
                                    <input id="Userid"class="form-control" type="number" name ="Att_User_Id" placeholder="User Id" required>

                                @if($errors->has('Att_User_Id'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('Att_User_Id')}}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Batchid" class="col-md-4 control-label">Batch Id</label>
                            <div class="col-md-6">
                                <select name="Att_Batch_Id" id="Batchid" class="form-control input-sm">
                                    <option>Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Present" class="col-md-4 control-label">Present(Yes/No)</label>
                            <div class="col-md-6">
                                <input id="Present"class="form-control" type="text" name ="Att_Present_Id" required>
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
        </div>
    </div>
    @endsection