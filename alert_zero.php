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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ZERO QUANTITY PRODUCT INFORMATION</i></b></h2><br>
</div>
<div class="panel" style="margin-left:3%">
  <div class="panel-heading">
      <h3 class="panel-title">
          <i class="fa fa-fw ti-credit-card"></i> Report
      </h3>
      <span class="pull-right">
          <i class="fa fa-fw ti-angle-up clickable"></i>
          <i class="fa fa-fw ti-close removepanel clickable"></i>
      </span>
  </div>
  <div id="printablediv"  class="panel-body">
      <div id="mainDiv"  class="row">
          <div class="col-lg-12">
              <div class="panel ">
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="sample_1">
                              <thead>
              <tr>
                  <th><strong>#</strong></th><th><strong> Product</strong></th>
                  <th ><strong>Quantity</strong></th><th ><strong>Min Quantity</strong></th>
                  <th><strong>Purchase Price</strong></th>
                  <th ><strong>Sale Price </strong></th><th ><strong>Total Amount </strong></th>
                  <th ><strong>Supplier </strong></th><th ><strong> Expiry Date</strong>
               <th ><strong> Action</strong>
              </tr>
                              </thead>
                              <tbody id="display">
                                <?php
                                $value=0;
                                  $serial = 0;
                                    $prodque =  "SELECT * FROM  product ";
                                    $prodfun = mysqli_query($connection,$prodque);
                                    while($proddata=mysqli_fetch_array($prodfun))
                                    {
                                        $prodid = $proddata['id'];
                                        $prodname = $proddata['title'];
                                        $minqnty = $proddata['min_quantity'];


                     $fetch =  "SELECT * FROM  stock_items WHERE quantity<='0' AND product_id='$prodid'  ";
                                    $run_name = mysqli_query($connection,$fetch);
                                    while($row=mysqli_fetch_array($run_name))
                                    {
                                       // SUM(total_cost)
                                       $sid = $row['id'];

                                       $supp = $row['supplier_id'];
                                       $total = $row['total_price'];
                                       $prodqnty = $row['quantity'];
                                      $xpiry = $row['expiry_date'];
                                      $purprice = $row['pur_price'];
                                      $saleprice = $row['sale_price'];

                    $fetch2 =  "SELECT * FROM  suppliers WHERE id='$supp' ";
                                    $run_name2 = mysqli_query($connection,$fetch2);
                                    while($row2=mysqli_fetch_array($run_name2))
                                    {
                                        $supplier=$row2['name'];



                                      $serial++;
                                     ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $prodname; ?></td>
                                        <td><?php echo $prodqnty; ?></td>
                                        <td><?php echo $minqnty; ?></td>
                                        <td><?php echo $purprice; ?></td>
                                        <td><?php echo $saleprice; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $supplier; ?></td>
                                        <td><?php echo $xpiry; ?></td> 
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="alert_zero.php?gid=<?php echo $sid;?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        
                      </div>
                    </td>
                                    </tr>
                                  <?php } }  }  ?> 
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
<?php
if (isset($_GET['gid'])) {
    $stkid=$_GET['gid'];

   $que2="DELETE FROM `stock_items` WHERE id='$stkid'";
$res2=mysqli_query($connection,$que2); 


}
?>