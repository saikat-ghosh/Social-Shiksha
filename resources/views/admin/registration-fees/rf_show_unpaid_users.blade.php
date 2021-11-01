@extends('layouts.admin_layouts.registration_fees_layout')

    @section('menu-content')
        <!-- Select unpaid user to pay registration fees -->
            <div id="select-student" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registration Fees
                            <a class="pull-right" href="{{ action('AdminController@selectUserType') }}"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Back </a>
                        </div>
                        <div class="panel-body">
                            <div>
                                @if(empty($unpaidUsers))
                                    <h4>No user with due registration fee found!</h4>
                                @else
                                    <h3>List of users with due registration fees.</h3>
                                    <ul class="list-group striped-list">
                                        @foreach($unpaidUsers as $id=>$unpaidUser)
                                            <li class="list-group-item">
                                                @if($User_Type == 'C')
                                                    <strong>{{ $unpaidUser->Inst_Name }}</strong>
                                                    <a href="{{ action('AdminController@payRegistrationFees',['institution',$unpaidUser->id]) }}"
                                                       class="btn btn-xs btn-info pull-right">Pay<span class="glyphicon glyphicon-chevron-right"></span>
                                                    </a>
                                                @elseif($User_Type == 'T')
                                                    <strong>{{ $unpaidUser->T_Stu_Name }}</strong>
                                                    <a href="{{ action('AdminController@payRegistrationFees',['teacher',$unpaidUser->id]) }}"
                                                       class="btn btn-xs btn-info pull-right">Pay<span class="glyphicon glyphicon-chevron-right"></span>
                                                    </a>
                                                @else
                                                    <strong>{{ $unpaidUser->T_Stu_Name }}</strong>
                                                    <a href="{{ action('AdminController@payRegistrationFees',['student',$unpaidUser->id]) }}"
                                                       class="btn btn-xs btn-info pull-right">Pay<span class="glyphicon glyphicon-chevron-right"></span>
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @endsection