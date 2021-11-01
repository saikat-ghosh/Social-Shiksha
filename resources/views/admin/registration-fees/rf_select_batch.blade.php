@extends('layouts.admin_layouts.registration_fees_layout')

       @section('menu-content')

           <div id="select-batch" class="row padding">
               <div class="col-md-8 col-md-offset-2">
                   <div class="panel panel-default">
                       <div class="panel panel-heading">
                           <b>Registration Fees</b>
                       </div>

                       <div class="panel panel-body">

                           @if($batches->isEmpty())
                               <h4>No ongoing batches!</h4>
                           @else
                            <form class="form-horizontal padding" action="{{ action('AdminController@showUnpaidUsers') }}" method="post">
                               <!-- Search by Batches -->
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="Batch_id" class="control-label">Select Batch First</label>
                                    <div>
                                        <select name="Batch_Id" id="Batch_id" class="form-control input-sm" required>
                                            <option value="">--Select--</option>
                                            @foreach($batches as $batch)
                                                <option value="{{$batch->id}}">{{$batch->Batch_Code}}-{{$batch->Batch_Subject}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                               <div class="form-group">
                                   <button type="submit" class="btn btn-primary pull-right">Next&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                               </div>
                            </form>
                            @endif
                       </div>
                   </div>
               </div>
           </div>

       @endsection