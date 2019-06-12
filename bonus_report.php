<?php
include 'includes/db.php';
$serial = 0;

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
<section class="content">
<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Bonus Report</i></b></h2><br>
</div>
<div class="row">
    <div  class="col-md-12" >
        <div class="panel " style="margin-left:3%">
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                <thead>
                  <tr>
                    <th>#</th>
                    <!-- <th>Supplier Name</th> -->
                    <th>Batch No: </th>                                
                    <th>Product: </th>
                    <th>Bonus</th>
                    <th>Purchase Price</th>
                    <th>Qunatity</th>          
                    <th>Date</th>    
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $serial = 0;
                  $query1="SELECT * FROM purchase";
                  $conn=mysqli_query($connection,$query1);
                  while ($row1=mysqli_fetch_array($conn)) {
                    $id=$row1['id'];
                    $supplier_id=$row1['supplier_id'];
                    $batch_no=$row1['batch_no'];
                    $product_id=$row1['product_id'];
                    $pur_price=$row1['pur_price'];
                    $quantity=$row1['quantity'];
                    $bouns=$row1['bonus'];
                    $total_price=$row1['total_price'];
                    $date=$row1['date'];
                    $serial = $serial + 1;

                    if($bouns > 0)
                    {



                  ?>
                  <tr>
                    <td><?php echo $serial; ?></td>
                    <!-- <td><?php 
                    $select = "SELECT * FROM suppliers WHERE id = '$supplier_id'";
                    $run = mysqli_query($connection,$select);
                    while($row = mysqli_fetch_array($run))
                    {
                      $name = $row['name'];
                      echo $name;
                    }
                    ?></td> -->
                    <td><?php echo $batch_no; ?></td>
                    <td><?php 
                    $select1 = "SELECT * FROM product WHERE id = '$product_id'";
                    $run1 = mysqli_query($connection,$select1);
                    while($row1 = mysqli_fetch_array($run1))
                    {
                      $title = $row1['title'];
                      echo $title;
                    }

                     ?></td>
                     <td><?php echo $bouns; ?></td>
                    <td><?php echo $pur_price; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $date; ?></td>
                  </tr>

                <?php } } ?>

                </tbody>
            </table>
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