
@extends('layouts.dashboard-layout')

    @section('navbar-menu-left')

        <!-- Left Navbar menu goes here -->
                <ul class="nav" id="main-menu">
				    <li>
                        <a class="active-menu"  href="student_dashboard.html"><i class="fa fa-home fa-2x"></i> Welcome Page</a>
                    </li>
                    <li>
                        <a  href="view_profile_S.php"><i class="fa fa-user fa-2x"></i> Profile</a>
                    </li>
                    <li>
                        <a  href="edit_batch_S.php"><i class="fa fa-edit fa-2x"></i> Edit Batch</a>
                    </li>
                    <li>
                        <a  href="#"><i class="fa fa-download fa-2x"></i> Study Material Download</a>
                    </li>
                    <li>
                        <a   href="student_mock_view.php"><i class="fa fa-download fa-2x"></i> Mock Test/ Practice Paper Download</a>
                    </li>	
                    <li>
                        <a  href="student_assignment_upload.php"><i class="fa fa-upload fa-2x"></i> Assignment Upload</a>
                    </li>
                    <li>
                        <a  href="student_view_assignment.php"><i class="fa fa-download fa-2x"></i> Assignment Download </a>
                    </li>
                    <li>
                        <a  href="Exam_fees_check.php"><i class="fa fa-pencil-square-o fa-2x"></i> Giving Exams</a>
                    </li>	
					<li>
                        <a  href="discussion_forum_S.html"><i class="fa fa-users fa-2x"></i> Discussion Forum</a>
                    </li>	
					<li>
                        <a  href="notice_board_S.php"><i class="fa fa-bell-o fa-2x"></i> Notice Board</a>
                    </li>		
                </ul>
    @endsection


    @section('page-content')
            <!-- Menu Content  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <img src="images/logo.png" alt="logo">
                                <p> <br> </p>
                                <div style="font-size: 120px;">
                                    <h1 style="font-family: Montserrat, Lato; color: red; text-decoration: none;font-size: 65%; text-shadow: 4px 4px 6px gray;font-style: none;"><u style="list-style: none;text-decoration: none;"><b> Welcome</b></u></h1>
                                </div>
                            </center>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <!-- /. PAGE INNER  -->
                </div>
                <!-- /. PAGE WRAPPER  -->
            </div>
@endsection