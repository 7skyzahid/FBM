<?php
include 'includes/db.php';
?>
<?php include 'session.php';  ?>
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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ALL STOCK PRODUCTS INFORMATION</i></b></h2><br>
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
       <div class="row">
    <div class="col-md-6">
       <h3>Total Products in Stock</h3>
    </div>
    <div class="col-md-6">
       <div class="text-center">
      <h3 class="text-dark"><b>
          <?php
          $product = "SELECT * FROM stock_items wHERE quantity>0";
          $run_pro = mysqli_query($connection,$product);
          $pro_total =  mysqli_num_rows($run_pro);
          echo $pro_total;
          ?>
      </b></h3>
     
  </div>
    </div>
  </div>
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
                  <th ><strong>Sale Price </strong></th>
                  <th ><strong>Total Amount </strong></th>
                  <th ><strong> Expiry Date</strong>
                  <th ><strong> Purchase Date</strong>
              </tr>
                              </thead>
                              <tbody id="display">
                                <?php
                                  $serial = 0;

$fetch =  "SELECT SUM(stock_items.quantity)as Total_Quantity,stock_items.pur_price,stock_items.sale_price,stock_items.total_price,stock_items.expiry_date,stock_items.bonus,stock_items.batch,stock_items.date, product.title AS product_name, product.min_quantity AS min

FROM  (stock_items 

INNER JOIN product ON stock_items.product_id=product.id)
WHERE stock_items.quantity>0
GROUP BY product.title
 ";
                               
                                $run_name = mysqli_query($connection,$fetch);
                                    while($row=mysqli_fetch_array($run_name))
                                    {
                                       $total =$row['total_price'];
                                       $prodqnty=$row['Total_Quantity'];
                                       $xpiry =$row['expiry_date'];
                                       $purprice=$row['pur_price'];
                                       $saleprice=$row['sale_price'];
                                       $bonus=$row['bonus'];
                                       $batch=$row['batch'];
                                       $date=$row['date'];
                                       $product=$row['product_name'];
                                       $minqnty=$row['min'];
                                       
                                      $serial++;
                                     ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $product; ?></td>
                                        <td><?php echo $prodqnty; ?></td>
                                        <td><?php echo $minqnty; ?></td>
                                        <td><?php echo $purprice; ?></td>
                                        <td><?php echo $saleprice; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $xpiry; ?></td> 
                                        <td><?php echo $date; ?></td>
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
<script type="text/javascript">
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>