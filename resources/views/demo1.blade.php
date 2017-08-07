@extends('layouts.teacher_layouts.teacher_profile_layout')

    @section('menu-content')

        <div id="view-profile" class="row padding">
            <div class="col-sm-11 col-sm-offset-1 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading">Profile Information</div>

                    <div class="panel-body padding">

                        <form class="form-horizontal" role="form" action="#" method="POST">

                            <div class="form-group{{$errors->has('EU_User_Id')? 'has-error' : ""}}">
                                <label for="Userid" class="col-md-4 control-label">User Id</label>
                                <div class="col-md-6">
                                    <input id="Userid"class="form-control" type="number" name ="EU_User_Id" placeholder="User Id" required>

                                    @if($errors->has('EU_User_Id'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('EU_User_Id')}}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Batchid" class="col-md-4 control-label">Batch Id</label>
                                <div class="col-md-6">
                                    <select name="EU_Batch_Id" id="Batchid" class="form-control input-sm" value="Select">
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Ename" class="col-md-4 control-label">Exam name</label>
                                <div class="col-md-6">
                                    <input id="Ename"class="form-control" type="text" name ="EU_Nname" placeholder="Exam name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Examduration" class="col-md-4 control-label">Duration of Exam</label>
                                <div class="col-md-6">
                                    <input id="Examduration"class="form-control" type="number" name ="EU_Duration" placeholder="Duration of exam" min="#">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Examquestion" class="col-md-4 control-label">Number of questions</label>
                                <div class="col-md-6">
                                    <input id="Examquestion"class="form-control" type="number" name ="EU_No_of_Q" placeholder="Number of question" max="#" min="#">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Examinstruction" class="col-md-4 control-label">Instructions</label>
                                <div class="col-md-6">
                                    <textarea id="Examinstruction"class="form-control" type="text" name ="EU_Instr" placeholder="Exam instructions" rows="5" cols="15"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <input name="Uploadfile" type="file"  required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit">
                                    <span class="glyphicon glyphicon-open"></span>  Upload
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
