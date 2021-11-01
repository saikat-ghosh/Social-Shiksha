@extends('layouts.admin_layouts.admin_app')

@section('menu-content')
    <div class="row padding">
        <div class="col-md-8 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Login</div>
                <div class="panel-body">
                    <!-- login form -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('Admin_User_Id') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Admin User Id</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="Admin_User_Id" value="{{ old('Admin_User_Id') }}" required autofocus>

                                @if ($errors->has('Admin_User_Id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Admin_User_Id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Admin_Pswd') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="Admin_Pswd" required>

                                @if ($errors->has('Admin_Pswd'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Admin_Pswd') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
