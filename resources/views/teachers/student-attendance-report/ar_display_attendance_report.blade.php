@extends('layouts.teacher_layouts.student_performance_report_layout')

       @section('menu-content')

           <div id="display-performance" class="row padding">
               <div class="col-md-11 col-md-offset-1">
                   <div class="panel panel-default">
                       <div class="panel panel-heading">
                           Attendance Report for <strong>{{ $student->T_Stu_Name }}</strong>
                           <a class="pull-right" href="{{ action('TeacherController@selectBatchForStudentAttendanceReport') }}"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Back </a>
                       </div>

                       <div class="panel panel-body no-margin-padding">

                           @if($attendanceDetails->isEmpty())
                               <h4>No attendance report found for the selected student!</h4>
                           @else
                               <table class="table table-responsive table-striped">
                                   <thead>
                                   <tr>
                                       <th>Total Working Days</th>
                                       <th>No. of days present</th>
                                       <th>No. of days absent</th>
                                       <th>Attendance Percentage</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td>{{ $attendanceReport['totalCount'] }}</td>
                                           <td>{{ $attendanceReport['presentCount'] }}</td>
                                           <td>{{ $attendanceReport['absentCount'] }}</td>
                                           <td>{{ $attendanceReport['percentage'] }}%</td>
                                       </tr>
                                   </tbody>
                               </table>
                           @endif
                       </div>
                   </div>
               </div>
           </div>

       @endsection