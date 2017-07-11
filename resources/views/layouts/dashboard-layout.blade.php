<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Social Shiksha</title>
        <!-- BOOTSTRAP STYLES-->
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link href={{asset("/css/bootstrap.css")}} rel="stylesheet" />
        <!-- FONT-AWESOME STYLES-->
        <link href={{asset("/css/font-awesome.css")}} rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href={{asset("/css/custom.css")}} rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>


    <body>
        <div id="wrapper" style="font-family: Montserrat, Lato; color: gray;">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/institution/dashboard')}}"><img src={{asset("images/logo.png")}} alt="logo"></a>
                </div>
                <div style="color: white;
                        padding: 15px 50px 5px 50px;
                        float: right;
                        font-size: 16px;"><a class="btn btn-danger square-btn-adjust" href="{{ url('/logout') }}"
                                             onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <span class="fa fa-power-off"></span>Logout
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                </div>
                <!-- Submit this form while logging out -->
            </nav>

            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">

                    <!-- Left Navigation bar goes here-->
                    @yield('navbar-menu-left')
                </div>
            </nav>
            <!-- End of Navbar -->

            <!-- Page Content  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <!-- Logo -->
                                <img src={{asset("images/logo.png")}} alt="logo">
                                <p> <br> </p>
                                <div style="font-size: 120px;">

                                    <!-- Menu Content goes here -->
                                    @yield('menu-content')
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
        </div>
        <!-- End of page contents -->


        <!-- ADDITIONAL SCRIPTS AT THE BOTTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="js//jquery-1.4.2.min.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="js/jquery.metisMenu.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="js/custom.js"></script>

    </body>
</html>