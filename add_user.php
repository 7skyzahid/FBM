<?php include 'server.php';  ?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php' ?>
</head>

<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>

<aside class="right-side">
    <!-- Main content -->
    <section class="content">
<div class="container">
    <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ADD USER </i></b></h2><br>
</div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 login-form">
            <div class="panel-header">
              
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php  if (count($errors) > 0) : ?>
    <div class="form-group">
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
    <?php endforeach ?>
  </div>
</div>
<?php  endif ?>
     <form  id="authentication" method="post" class="signup_validator">
                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Account Type</label>
                                <select   name="type" class="form-control  form-control-lg">
                                    <option>Select Type</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="sr-only"> E-mail</label>
<input type="text" class="form-control  form-control-lg" id="email" name="email" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
<input type="password" class="form-control form-control-lg" id="password" name="password_1" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="confirm-password" class="sr-only">Password</label>
<input type="password" class="form-control form-control-lg" id="confirm-password" name="password_2" placeholder="Confirm Password">
                            </div>
                        </div>
                     
                        <div class="col-md-12">
                            <div class="form-group">
                        <input type="submit"  name="register" id="save" value="Sign Up" class="btn btn-primary btn-block"/>
                        <a href="index.php" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                         
                        </div>
                    </form>
                </div>
             
            </div>
        </div>
    </div>
</div>

        


<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<script src="js/app.js" type="text/javascript"></script>
<!-- end of page level js -->
<script src="vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="js/custom_js/register.js"></script>
<script src="vendors/iCheck/js/icheck.js"></script>
<script src="vendors/moment/js/moment.min.js"></script>
<script src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
