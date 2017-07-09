@extends('layouts.dashboard-layout')

    @section('navbar-menu-left')

        <!-- Left Navigation Bar menu -->
                <ul class="nav" id="main-menu">
				    <li>
                        <a  href="{{url('institution/dashboard')}}"><i class="fa fa-home fa-2x"></i> Welcome Page</a>
                    </li>
                    <li>
                        <a  href="#" class="active-menu"><i class="fa fa-user fa-2x"></i> Edit Profile</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/batch-details')}}"><i class="fa fa-edit fa-2x"></i> Batches</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/teacher-details')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Teacher Details Report</a>
                    </li>
                    <li>
                        <a  href="{{url('institution/student-details')}}"><i class="fa fa-pencil-square-o fa-2x"></i> Student Details Report</a>
                    </li>
					<li>
                        <a  href="{{url('institution/notice-board')}}"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>		
                </ul>

    @endsection


    @section('menu-content')
            <!-- Institution's profile information goes here -->
            <!-- /. ROW  -->
            <div id="templatemo_content_wrapper" style="margin:0px; width:auto;">
                <center>
                    <div id="templatemo_content"  style="margin:0px; width:auto;">

                        <div class="content_box" style="margin:0px; width:auto;" >

                            <h2><center><u><b>Institution's Profile</b></u></center></h2>




                            <div class="imgcontainer" style=" margin-right: 20px; margin-left: 30px">
                                <center>     <a href="edit_profile_C.php" style="background-color: #c4efff;"><b>Edit Profile</b></a>
                                </center>
                            </div>
            <form action="/action_page.php">
                <div class="imgcontainer" style=" margin-right: 20px; margin-left: 30px">
                    <h2 style="color: #049b07; text-align: left"><b>User Profile</b></h2>

                    <table class="table" style="width:100%; text-align: left;">
                        <tr>
                            <td ><br><br></td>
                            <td><br><br></td>
                        </tr>
                        <tr>
                            <td style="color: black"><b>Institution Name</b></td>
                            <td></td>
                            <td style="color: black"><b>Exam Type</b></td>
                            <td>></td>
                        </tr>
                        <tr>
                            <td  style="color: black"><b>User ID</b></td>
                            <td></td>
                            <td  style="color: black"><b>Phone Number</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td  style="color: black"><b>Address</b></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </form>



            <div class="cleaner"></div>
            </div>
            </div> <!-- end of content -->
            </center>
            <div class="cleaner"></div>


            </div>
            <hr />

            </div>

    @endsection