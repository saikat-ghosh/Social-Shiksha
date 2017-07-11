
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
            <center>	<img src={{asset("images/logo.png")}} align="center">
            </center>
            <p><br><br></p>
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="{{ route('login') }}" class="active" id="login-form-link">Login</a>
                        </div>

                        <div class="col-xs-6">
                            <a href="{{ route('register') }}" id="register-form-link">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <p><br><br><br></p>
        </div>
    </div>
</div>






</body>
</html>