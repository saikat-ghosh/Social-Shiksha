@extends('layouts.institution_layouts.batch_details_layout')

        @section('menu-content')

            <!-- Form for adding new batches to the institution goes here -->
            <div id="add-batch" class="row padding">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Add New Batch</div>
                            <div class="panel-body">

                                <form class="form-horizontal" role="form" action="{{ action('BatchController@store') }}" method="POST">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('Batch_Code') ? ' has-error' : '' }}">
                                        <label class="col-md-5 control-label" for="batch_code">Batch Code * </label>

                                        <div class="col-md-6">
                                            <input id="batch_code" type="text" class="form-control" name="Batch_Code" value="{{ old('Batch_Code') }}" required autofocus>

                                            @if ($errors->has('Batch_Code'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('Batch_Code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('Batch_Subject') ? ' has-error' : '' }}">
                                        <label for="batch-subject" class="col-md-5 control-label">Batch Subject *</label>

                                        <div class="col-md-6">
                                            <input id="batch-subject" type="text" class="form-control" name="Batch_Subject" value="{{ old('Batch_Subject') }}" required>

                                            @if ($errors->has('Batch_Subject'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('Batch_Subject') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                ADD
                                            </button>

                                            <a class="btn btn-link" href="{{ action('BatchController@index') }}">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- end of content -->

        @endsection