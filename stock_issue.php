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
    <!-- Content Header (Page header) -->
    <!-- Main content -->
<section class="content">
<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Stock Issue To Saleman</i></b></h2><a href="add_stock_issue.php" class="btn btn-primary">Add New</a><br>
</div>
<div class="row">
    <div  class="col-md-12">
        <div class="panel " style="margin-left:3%">
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="sample_1">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Saleman</th>
                        <th>Sale Policy</th>
                        <th>Product Name</th>
                        <th>Packing Name</th>
                        <th>Pack</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Bonus</th>
                        <th>Total</th>
                        <th>Date</th>                          
                    </tr>
                  </thead>
            <tbody>
             <?php
                $serial = 0;
                $select = "SELECT * FROM stock_issue";
                $run = mysqli_query($connection,$select);
                while($row= mysqli_fetch_array($run))
                {
                    $serial =$serial +1;
                    $id1 = $row['id'];
                    $saleman_id = $row['saleman_id'];
                    $product_id = $row['product_id'];
                    $packing_id = $row['packing_id'];
                    $pack = $row['pack'];
                    $qty = $row['qty'];
                    $price = $row['price'];
                    $bonus = $row['bonus'];
                    $policy = $row['policy_id'];
                    $total = $row['total'];
                    $date = $row['date'];
                    $newDate = date("d-m-Y", strtotime($date));
            ?>
            <tr>
                <td><?php echo $serial; ?></td>
                <td>
                <?php
                $select2 = "SELECT * FROM sales_mens WHERE id = $saleman_id";
                $run2 = mysqli_query($connection,$select2);
                while($row = mysqli_fetch_array($run2))
                {
                    echo $row['sales_men_name'];
                }
                ?>
                </td>
                <td>

                <?php
                $select22 = "SELECT * FROM sale_policies";
                $run22 = mysqli_query($connection,$select22);
                while($row = mysqli_fetch_array($run22))
                {
                    echo $row['policy_name'];
                }
                ?>

                </td>
              
                <td>
                <?php
                $select1 = "SELECT * FROM product WHERE id = $product_id";
                $run1 = mysqli_query($connection,$select1);
                while($row = mysqli_fetch_array($run1))
                {
                    echo $row['title'];
                }
                ?>
                </td>
                <td>
                <?php
                $select3 = "SELECT * FROM packings WHERE id = $packing_id";
                $run3 = mysqli_query($connection,$select3);
                while($row = mysqli_fetch_array($run3))
                {
                    echo $row['packing_name'];
                }
                ?>
                </td>
                <td><?php echo $pack; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $bonus; ?></td>
                <td><?php echo $total; ?></td>
                
                <td><?php echo $newDate; ?></td>

                <!-- <td class="text-center">
                      <div class="btn-group">
                        <a href="update_expense.php?gid=<?php echo $id1;?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="view_expenses.php?delete=<?php echo $id1;?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                </td> -->


                <?php } ?>
            </tr>
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
<?php
if(isset($_GET['delete']))
{
    $delete = $_GET['delete'];
    $sql  = "DELETE FROM expenses WHERE id = '$delete'";
    $run = mysqli_query($connection,$sql);
}

?>