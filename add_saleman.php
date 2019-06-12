<?php
include 'includes/db.php';
?>
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


        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<div class="box-header with-border">
    
        
    
<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Add New Saleman <br><br> <a href="view_saleman.php" class="btn btn-primary" >View Saleman</a> </i></b></h2><br>
</div>
   <div class="row" >
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>New Saleman</span>
         </strong>
        </div>
<div class="panel-body">
  <form method="post"  action="">

<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="name1"  placeholder="Name" >
</div></div>
</div>
<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Address</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="address"  placeholder="Adrees" >
</div></div>
</div>
<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Mobile No</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="mobile"  placeholder="Capicity" >
</div></div>
</div>

<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Commision Rate</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="rate"  placeholder="Commision Rate" >
</div></div>
</div>


<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="add_warehouse.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>

  </form>

<?php
if (isset($_POST['save'])) {
    $name = $_POST['name1'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $rate = $_POST['rate'];
    
    $date = date('Y-m-d');

  
$query ="INSERT INTO sales_mens(sales_men_name,address,mobile_number,commission_ration,created_at)
VALUES ('$name','$address','$mobile','$rate','$date')";
    $result = mysqli_query($connection, $query);
    if($result){
   echo' <script>window.location.href = "add_saleman.php";</script>';
}
   
}


?>
  </div>
</div>
</div>


   </div>
   </div>
</div>
  

<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>
<!-- end of page level js -->
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
