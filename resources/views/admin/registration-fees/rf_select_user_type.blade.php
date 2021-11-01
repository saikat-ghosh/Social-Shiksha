@extends('layouts.admin_layouts.registration_fees_layout')

       @section('menu-content')

           <div id="select-batch" class="row padding">
               <div class="col-md-8 col-md-offset-2">
                   <div class="panel panel-default">
                       <div class="panel panel-heading">
                           <b>Registration Fees</b>
                       </div>

                       <div class="panel panel-body">

                            <form class="form-horizontal padding" action="{{ action('AdminController@showUnpaidUsers') }}" method="post">
                                {{ csrf_field() }}
                               <!-- Search by Batches -->
                                <div class="form-group">
                                    <label for="User_Type" class="control-label">Select User Type</label>
                                    <div>
                                        <select name="User_Type" id="User_Type" class="form-control input-sm" required>
                                            <option value="">--Select--</option>
                                            <option value="C">Institute</option>
                                            <option value="T">Teacher</option>
                                            <option value="S">Student</option>
                                        </select>
                                    </div>
                                </div>

                               <div class="form-group">
                                   <button type="submit" class="btn btn-primary pull-right">Next&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></button>
                               </div>
                            </form>
                       </div>
                   </div>
               </div>
           </div>

       @endsection