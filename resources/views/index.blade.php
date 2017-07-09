
<!DOCTYPE html>

<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!--jQuery library-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!--Latest compiled and minified JavaScript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/indexStyle.css" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.4.2.min.js" ></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/cufon-replace.js"></script>
    <script type="text/javascript" src="js/Myriad_Pro_300.font.js"></script>
    <script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <script src="js/index/s1.js">

    </script>

</head>


<body>


<div class="container" style="padding-top:50px;">
    <div class="row row_style pl">
        <div class="col-xs-offset-1 col-xs-10 col-md-offset-3 col-md-6">
            <center>	<img src="images/logo.png" align="center">
            </center>
            <p><br><br></p>
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>

                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>                        </div>
                <div class="panel-body">

                    <!-- User Login form -->
                    <form id="login-form" action="{{ url('teacher/dashboard') }}" method="post" role="form" style="display: block;">

                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="email" id="email" tabindex="1" required class="form-control" placeholder="Username OR Email-ID">
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" id="password" tabindex="2" required class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group text-center">
                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                            <label for="remember"> Remember Me</label>
                        </div>

                        <div class="form-group text-center">
                            <select name="who" class="form-control input-sm" required>
                                <option value="Institute">Institute</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Student">Student</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-primary" value="Log In">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <a href="forgotpassword.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                    <!-- User Registration form -->
                    <form id="register-form"  name="fname" action="signup.php" method="post"  onsubmit="return validateForm()" role="form" style="display: none;">
                        <div class="form-group">
                            <input type="text" required  name="name"  tabindex="1" class="form-control" placeholder="Name" value="" style="height: 30px">
                        </div>

                        <div class="form-group">
                            <input type="text" pattern="[7-9]{1}[0-9]{9}" name="mobile"  tabindex="2" class="form-control" placeholder="Mobile  Number (must be of 10 digits only)" value="" style="height: 30px">
                        </div>

                        <div class="form-group">
                            <input type="text" name="userid"  tabindex="3" class="form-control" required placeholder="Username" style="height: 30px">
                        </div>

                        <div class="form-group">
                            <input type="email" name="email"  tabindex="4" class="form-control" required placeholder="Email Address" style="height: 30px">
                        </div>

                        <div class="form-group">
                            <input type="password" name="pass"  tabindex="5" class="form-control" required  placeholder="Password" value="" style="height: 30px">
                        </div>

                        <div class="form-group">
                            <input type="password" name="cpass"  tabindex="6" required class="form-control" placeholder="Confirm Password" value="" style="height: 30px">
                        </div>

                        <div class="form-group text-center" tabindex="7">
                            <select name="who" class="form-control input-sm" required>
                                <option value="Institute">Institute</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Student">Student</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="register-submit" id="register-submit" tabindex="8" class="form-control btn btn-primary" value="Register Now">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
            <p><br><br><br></p>
        </div>
    </div>
</div>






</body>
</html>