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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ALL PACKAGE INFORMATION</i></b></h2><br>
</div>
<div class="panel" >
<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-fw ti-credit-card"></i> All Packages
</h3>
<span class="pull-right">
<i class="fa fa-fw ti-angle-up clickable"></i>
<i class="fa fa-fw ti-close removepanel clickable"></i>
</span>
</div>
<div id="printablediv" class="panel-body">
<div id="mainDiv" class="row">
<div class="col-lg-12">
<div class="panel ">
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
<tr>
<th><strong>#</strong></th>
<th><strong> Package</strong></th>
<th><strong> Grand </strong></th>
<th ><strong> Date </strong></th>
<th ><strong>Action </strong></th>
</tr>
</thead>
<tbody id="display">
<?php
$serial = 0;
$prodque = "SELECT DISTINCT (package.name),package_amount.grand,package_amount.created_at,package.package_id
FROM (package
INNER JOIN package_amount ON package.package_id=package_amount.id)";
$prodfun = mysqli_query($connection,$prodque);
while($proddata=mysqli_fetch_array($prodfun))
{
      $id = $proddata['package_id'];
     
      $package = $proddata['name'];
      $grand = $proddata['grand'];
      $date = $proddata['created_at'];

$serial++;
?>
<tr>
<td><?php echo $serial;?></td>
<td><?php echo $package?></td>
<td><?php echo $grand; ?></td>
<td><?php echo $date; ?></td>

    <td class="text-center">
                      <div class="btn-group">
                        <a href="view_package.php?gid=<?php echo $id;?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="View">
                          <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                        
                      </div>
                    </td>
</tr>
<?php }  ?> 
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
<script>
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>