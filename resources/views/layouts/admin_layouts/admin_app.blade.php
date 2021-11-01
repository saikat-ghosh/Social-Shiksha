<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->

        <!-- BOOTSTRAP STYLES-->
        <link href={{asset("/css/app.css")}} rel="stylesheet" />
        <!-- FONT-AWESOME STYLES-->
        <link href={{asset("/css/font-awesome.css")}} rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="{{asset("/css/customStyles.css")}}" rel="stylesheet">
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- GLYPHICON STYLES -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <!-- RateYO Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
        <!-- Page Specific Additional Styles goes here -->
        <style>@stack('css')</style>
        <!-- Scripts ->
        <script src="{{asset('/js/app.js')}}"></script-->
        <script src="{{url('http://code.jquery.com/jquery-1.11.0.min.js')}}"></script>
        <script src="{{url('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js')}}"></script>
        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <!-- Page Specific Additional Javascript codes goes here -->
        @stack('js')
    </head>

    <body>
        <div id="app" class="content">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if(session('Admin_User_Id') == 'korak')
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <span class="glyphicon glyphicon-user"></span>{{ session('Admin_User_Id') }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('admin/logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                <span class="glyphicon glyphicon-off"></span>Logout
                                            </a>
                                            <!-- Submit this form while logging out -->
                                            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End of Navigation Bar -->

            <!-- Main Content goes here -->
            <div class="container-fluid no-margin-padding">

                <div class="row no-padding">

                    <!-- Left Sidebar goes here -->
                    <div class="col-sm-3">
                        @yield('sidebar-menu-left')
                    </div>
                    <!-- Sidebar Menu Content goes here -->
                    <div class="col-sm-7 small-font">

                        <!-- Social-Shiksha Logo -->
                        <div class="row">
                            <center>
                                <img src="{{asset('images\logo.png')}}">
                            </center>
                        </div>

                        <!-- Main Content -->
                        @yield('menu-content')
                    </div>
                    <!-- Right Sidebar goes here -->
                    <div class="col-sm-2 text-center">
                        @yield('sidebar-right')
                    </div>

                </div>

            </div>

        </div>
    <!-- End of Main Page -->

    <!-- Modal for showing Session Messages -->
        <div id="show-session-message" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="modal-close btn pull-right" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span></button>
                        <center>
                            <h4><span class="glyphicon glyphicon-info-sign"></span>&thinsp; Message</h4>
                        </center>
                    </div>
                    <div class="modal-body">
                        <center>
                            <p><strong>{{ session('message') }}</strong></p>
                            <button type="submit" class="btn btn-success" data-dismiss="modal">OK &thinsp;
                                <span class="small-font glyphicon glyphicon-ok-sign"></span>
                            </button>
                        </center>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <!-- Display Session Message Modal-->
        <script language="javascript">
            $(document).ready(function(){
                @if(session('message'))
                    $("#show-session-message").modal('show');
                @endif
            });
        </script>

    </body>
</html>
