



<!DOCTYPE html>
<html>


<head>
    <title> Registeration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- global css -->
    <link href="css/app.css" rel="stylesheet">
    <!-- end of global css -->
    <!--page level css -->
    <link type="text/css" href="vendors/themify/css/themify-icons.css" rel="stylesheet"/>
    <link href="vendors/iCheck/css/all.css" rel="stylesheet">
    <link href="vendors/bootstrapvalidator/css/bootstrapValidator.min.css" rel="stylesheet"/>
    <link href="css/login.css" rel="stylesheet">
    <!--end of page level css-->
</head>

<body id="sign-up">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 login-form">
            <div class="panel-header">
                <h2 class="text-center">
                    <img src="img/pages/clear_black.png" alt="Logo">
                </h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form  id="authentication" action="registration.php" method="post" class="signup_validator">
                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="sr-only">Email</label>
                                <input type="email" class="form-control form-control-lg" 
                                       name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="text" class="sr-only">UserName</label>
                                <input type="text" class="form-control  form-control-lg" id="email" name="username"
                                       placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                       name="password" placeholder="Password">
                            </div>
                        </div>
                                           
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit"  name="register" value="Sign Up" class="btn btn-primary btn-block"/>
                            </div>
                         
                        </div>
                    </form>
                </div>
             
            </div>
        </div>
    </div>
</div>


<?php

if(isset($_POST['register'])){

require __DIR__ . '/vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "mysql";




    $db = new PDO("mysql:host=$servername;dbname=clinic", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    

   $auth = new \Delight\Auth\Auth($db);


    $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {
        echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
    });

    echo '<script>alert("We have signed up a new user with the ID")</script> ' . $userId;


}

?>


<!-- global js -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script src="vendors/moment/js/moment.min.js"></script>
<script src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="vendors/select2/js/select2.js"></script>
<script src="vendors/iCheck/js/icheck.js"></script>
<script src="vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="js/custom_js/register.js"></script>
<!-- end of page level js -->
</body>


</html>
