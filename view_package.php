<?php
include 'includes/db.php';

?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php' ?>
</head>

<body class="skin-default">
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php include 'includes/menu.php' ?>

<aside class="right-side">
<section class="content">
<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i> PACKAGE INFORMATION</i></b></h2><br>
</div>
<div class="panel" >
<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-fw ti-credit-card"></i>  Package
</h3>
<span class="pull-right">
<i class="fa fa-fw ti-angle-up clickable"></i>
<i class="fa fa-fw ti-close removepanel clickable"></i>
</span>
</div>
<div class="panel-body">
<div id="mainDiv" class="row">
<div class="col-lg-12">
<div class="panel ">
<div class="panel-body">
  <div class="row"   >
    <?php
if (isset($_GET['gid'])) {
       $gid=$_GET['gid'];

$serial = 0;
$packque = "SELECT * FROM package WHERE package_id='$gid'";
$pacres = mysqli_query($connection,$packque);
while($packdata=mysqli_fetch_array($pacres))
{
        $pacname = $packdata['name'];
      }
    }
      ?>

<div class="col-md-3"></div>
      <div class="col-md-3">
          <div class="form-group">
               <label><b>Title</b><span class="text-danger">*</span></label>
          <h3><?php echo $pacname;  ?></h3>
      </div>
      </div>
<div class="col-md-3"></div>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th><strong>#</strong></th>
<th><strong> Products</strong></th>
<th><strong> Price </strong></th>
<th ><strong> Quantity</strong></th>
<th ><strong> Total </strong></th>


</tr>
</thead>
<tbody id="display">
<?php
$serial = 0;
$prodque = "SELECT * FROM package WHERE package_id='$gid'";
$prodfun = mysqli_query($connection,$prodque);
while($proddata=mysqli_fetch_array($prodfun))
{
   
      $item = $proddata['products'];
      $price = $proddata['price'];
      $quantity = $proddata['quantity'];
      $total = $proddata['total'];

 
$fetch2 = "SELECT * FROM product WHERE id='$item' ";
$run_name2 = mysqli_query($connection,$fetch2);
while($row2=mysqli_fetch_array($run_name2))
{
      $prodname = $row2['title'];


$serial++;
?>
<tr>
<td><?php echo $serial;?></td>
<td><?php echo $prodname?></td>
<td><?php echo $price; ?></td>
<td><?php echo $quantity;?></td>
<td><?php echo $total; ?></td>


    
</tr>
<?php } }   ?> 
</tbody>
</table>


<?php

$fetch5 = "SELECT * FROM package_amount WHERE id='$gid' ";
$run_name5 = mysqli_query($connection,$fetch5);
while($row2=mysqli_fetch_array($run_name5))
{   
        $grand = $row2['grand'];
        $date = $row2['created_at'];



?>
<div class="col-md-3">
<label for="last_Name"><b>Grand Total:</b></label>
</div>

<div class="col-md-3">
<h4><b><?php echo $grand; ?></b></h4>
 </div>
<div class="col-md-3">
<label><b>Date:</b></label>
</div>
<div class="col-md-3">
<h4><b><?php echo $date?></b></h4>
</div>
<?php }  ?>
</div>
</div>



</div>

</div>
</div>
</div>
</div>
</section>
</aside>
</div>


<?php include 'includes/right-menu.php' ?>
<!-- /.right-side -->

<script src="js/app.js" type="text/javascript"></script>
</body>
</html>
<script>
document.onkeyup = function(e) {
if (e.which == 27) {
window.location.href = "all_packages.php";
}
};
</script>
