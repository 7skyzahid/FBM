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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ALL MATERIALS INFORMATION</i></b></h2><br>
</div>
<div class="panel"  style="margin-left:3%">
<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-fw ti-credit-card"></i> All Materials
</h3>
<span class="pull-right">
<i class="fa fa-fw ti-angle-up clickable"></i>
<i class="fa fa-fw ti-close removepanel clickable"></i>
</span>
</div>
<div id="printablediv" class="panel-body">
   <div class="row">
    <div class="col-md-6">
       <h3>Total Registered Raw Materials </h3>
    </div>
    <div class="col-md-6">
       <div class="text-center">
      <h3 class="text-dark"><b>
          <?php
          $product = "SELECT * FROM materials";
          $run_pro = mysqli_query($connection,$product);
          $pro_total =  mysqli_num_rows($run_pro);
          echo $pro_total;
          ?>
      </b></h3>
     
  </div>
    </div>
  </div>
<div id="mainDiv" class="row">
<div class="col-lg-12">
<div class="panel ">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th><strong>#</strong></th>
<th><strong> Product</strong></th>
<th ><strong>Category</strong></th>
<th ><strong>Company </strong></th>
<th ><strong>Action </strong></th>
</tr>
</thead>
<tbody id="display">
<?php
$serial = 0;
$que1 = "SELECT * FROM materials";
$res1 = mysqli_query($connection,$que1);

while($proddata=mysqli_fetch_array($res1))
{
$prdid = $proddata['id'];
$prodname = $proddata['title'];
$category_id = $proddata['category_id'];
$company_id = $proddata['company'];


$que3 = "SELECT * FROM company  WHERE id='$company_id' ";
$res3 = mysqli_query($connection,$que3);
while($row3=mysqli_fetch_array($res3))
{
$company_name = $row3['name'];


$que2 = "SELECT * FROM stock_categories WHERE id='$category_id' ";
$res2 = mysqli_query($connection,$que2);
while($row2=mysqli_fetch_array($res2))
{
$stock_name = $row2['title'];



$serial++;
?>
<tr>
<td><?php echo $serial; ?></td>
<td><?php echo $prodname; ?></td>
<td><?php echo $stock_name; ?></td>
<td><?php echo $company_name; ?></td>
    <td class="text-center">
                      <div class="btn-group">
                        <a href=""  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        
                      </div>
                    </td>
</tr>
<?php } } }  ?> 
</tbody>
</table>
</div>
</div>
</div>
</div>


</div>

</div>
</div>


<?php include 'includes/right-menu.php' ?>
<!-- /.right-side -->
</div>
<script src="js/app.js" type="text/javascript"></script>
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>

</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>