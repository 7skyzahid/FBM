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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Update Warehouse  </i></b></h2><br>
</div>
   <div class="row" >
    <div class="col-md-2"></div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Warehouse</span>
         </strong>
        </div>
<div class="panel-body">
  <?php
  if(isset($_GET['gid']))
  {
    $gid = $_GET['gid'];
    $select_w = "SELECT * FROM warehouses where id = $gid ";
    $run_w = mysqli_query($connection,$select_w);
    while($row= mysqli_fetch_array($run_w))
    {
        
        $id1 = $row['id'];
        $warehouse_name = $row['warehouse_name'];
        $warehouse_address = $row['warehouse_address'];
        $capacity = $row['capacity'];
        $date = $row['created_at'];

  }
  ?>
  <form method="post"  action="">

<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="name1" value="<?php echo $warehouse_name ?>"  placeholder="Name" >
</div></div>
</div>
<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Address</b><span class="text-danger">*</span></label>
<input type="text" value="<?php echo $warehouse_address ?>"   class="form-control input-sm" name="address"  placeholder="Adrees" >
</div></div>
</div>
<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Capicity</b><span class="text-danger">*</span></label>
<input type="text" value="<?php echo $capacity ?>"   class="form-control input-sm" name="capicity"  placeholder="Capicity" >
</div></div>
</div>


<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="view_warehouse.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>

  </form>


<?php
}
if (isset($_POST['save'])) {
    $name = $_POST['name1'];
    $address = $_POST['address'];
    $capicity = $_POST['capicity'];
    $date = date('Y-m-d');

  
$query ="UPDATE  warehouses SET warehouse_name = '$name', warehouse_address = '$address', capacity = '$capicity', created_at = '$date' WHERE id = $gid ";
    $result = mysqli_query($connection, $query);
    if($result){
   echo' <script>window.location.href = "view_warehouse.php";</script>';
}
   
}


?>
  </div>
</div>
</div>


   </div>
   </div>
</div>
  


<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
$que2="DELETE FROM `stock_categories` WHERE id='$id'";
$res2=mysqli_query($connection,$que2);
if($res2){
   echo' <script>window.location.href = "add_category.php";</script>';
}
}?>



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
