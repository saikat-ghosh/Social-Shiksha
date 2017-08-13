@extends('layouts.teacher_layouts.student_performance_report_layout')

       @section('menu-content')

           <div id="display-performance" class="row padding">
               <div class="col-md-11 col-md-offset-1">
                   <div class="panel panel-default">
                       <div class="panel panel-heading">
                           Performance Report for <strong>{{ $student->T_Stu_Name }}</strong>
                           <a class="pull-right" href="{{ action('TeacherController@selectBatchForStudentPerformanceReport') }}"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;Back </a>
                       </div>

                       <div class="panel panel-body no-margin-padding">

                           @if(empty($performanceReport))
                               <h4>No performance report found for the selected student!</h4>
                           @else
                               <table class="table table-responsive table-striped">
                                   <thead>
                                   <tr>
                                       <th>Exam Name</th>
                                       <th>Upload Date</th>
                                       <th>Total Marks</th>
                                       <th>Obtained Marks</th>
                                       <th>Percentage</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                        @foreach($performanceReport as $report)
                                           <tr>
                                               <td>{{ $report['Exam_Name'] }}</td>
                                               <td>{{ $report['Upload_Date'] }}</td>
                                               <td>{{ $report['Total_Marks'] }}</td>
                                               <td>{{ $report['Obtained_Marks'] }}</td>
                                               <td>{{ $report['Percentage'] }}%</td>
                                           </tr>
                                        @endforeach
                                   </tbody>
                               </table>
                           @endif
                       </div>
                   </div>
               </div>
           </div>

       @endsection