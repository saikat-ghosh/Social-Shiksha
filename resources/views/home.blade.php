@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <!-- Page Content goes here -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal for  -->
<div id="session-message" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                <h4><span class="glyphicon glyphicon-pencil"></span> Edit Profile</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal padding" action="{{ action('InstitutionController@update_profile') }}" method="POST" role="form">
                    {{ csrf_field() }}

                    <input type="hidden" name="Ent_Type" value="E">
                    <button type="submit" class="btn btn-block btn-theme">Update
                        <span class="glyphicon glyphicon-send"></span>
                    </button>

                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
