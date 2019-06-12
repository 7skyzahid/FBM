<?php   $db = mysqli_connect('localhost','root','mysql','clinic');
 ?>
<?php
if(isset($_GET['update'])){
    $uid=$_GET['update'];
      $uquery = "SELECT * FROM users WHERE id='$uid' ";
  $result1 = mysqli_query($db, $uquery);
  while ($row=mysqli_fetch_array($result1)) {
        $mail=$row['email'];  }}?>


<?php


// initializing variables
$type = "";
$email    = "";
$errors = array(); 
$date=date("Y-m-d");
// connect to the database

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  // if (empty($type)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Conform Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The  Password do not match");
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

$query="UPDATE `users` SET `type`='$type',`email`='$email',`password`='$password',`updated_at`='$date'
          WHERE `id`= '$uid'";

    mysqli_query($db, $query);
  }
}
 ?>


<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php'; ?>
<?php include 'includes/db.php'; ?>
</head>

<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php'; ?>

<aside class="right-side">
    <!-- Main content -->
    <section class="content">

<!-- header logo: style can be found in header-->
<header class="header">
   
        
        <!-- Main content -->
        <section class="content">
            <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ADD USER </i></b></h2><br>
</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="livicon" data-name="user-add" data-size="18" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i> Edit User
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <!-- errors -->
                            <!--main content-->
<form  method="POST"  class="form-horizontal">
    <div id="pager_wizard">
        <ul>
            <li>
                <a href="#tab1" data-toggle="tab">User Profile</a>
            </li>
         
        </ul>
        <div class="tab-content">
            <div class="tab-pane"  id="tab1" >
                <h2 class="hidden">&nbsp;</h2>




<?php  if (count($errors) > 0) : ?>
    <div class="form-group">
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
    <?php endforeach ?>
  </div>
</div>
<?php  endif ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Account Type *</label>
            <div class="col-sm-10">
                <select   name="type" class="form-control  form-control-lg">
                <option>Select Type</option>
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
                </select>
                                                </div>
                                            </div>
                                           
                <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email *</label>
                <div class="col-sm-10">
<input type="email"  id="email" name="email"  
                        class="form-control required email" value="<?php echo $mail;?>"/>
                </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password *</label>
                    <div class="col-sm-10">
<input  name="password_1" type="password" id="password" 
                               placeholder="Password" class="form-control required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirm" class="col-sm-2 control-label">Confirm
                        Password*</label>
                    <div class="col-sm-10">
<input  name="password_2" type="password" id="password" 
                          placeholder="Conform Password" class="form-control required"/>
                    </div>
                </div>
                <div class="form-group" align="center">
                    <div class="col-sm-10">
<button  name="register" type="submit"  id="save" class="btn btn-primary">Update</button>
<a   href="user_list.php"  class="btn btn-danger">Cancel</a>
                    </div>
                </div>
                                        </div>
                                       
                                    </div>
                                </div>
                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
    </aside>
</div>


<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>
<script src="vendors/moment/js/moment.min.js"></script>
<script src="vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
<script src="vendors/select2/js/select2.js" type="text/javascript"></script>
<script src="vendors/bootstrapwizard/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
<script src="vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="vendors/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="vendors/iCheck/js/icheck.js" type="text/javascript"></script>
<script src="js/custom_js/adduser.js" type="text/javascript"></script>

<!-- end of page level js -->
</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "user_list.php";
}
};
</script>


