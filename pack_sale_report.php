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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Package Sale Report</i></b></h2><br>
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
                    <th>Invoice No</th>
                    <th>Customer Name</th>
                    <th>Total Price</th>
                    <th>Paid Amount</th>
                    <th>Due Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                 </tr>
                </thead>
                <tbody>

                <?php
                $serial  = 0;
                $query  =  "SELECT * FROM stock_sales order by created_date DESC";;
                $run = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($run))
                {
                    $serial = $serial + 1; 
                    $ss_id = $row['id'];
                    $customer = $row['customer'];
                    $total = $row['grand_total_amount'];
                    $paid_amount = $row['paid_amount'];
                    $due_amount = $row['due_amount'];
                    $date = $row['created_date'];
                    

                  ?>
                  <tr>
                    <td><?php echo $serial ; ?></td>
                    <td><?php echo $ss_id ; ?></td>
                    <td><?php echo $customer ; ?></td>
                    <td><?php echo $total ; ?></td>
                    <td><?php echo $paid_amount ; ?></td>
                    <td><?php echo $due_amount ; ?></td>
                    <td><?php echo $date ; ?></td>
                    
                   

                    <td class="text-center">
                        <div class="btn-group">
                          <a href="update_return-sale.php?gid=<?php echo $ss_id;?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                            <span class="glyphicon glyphicon-edit"></span>
                          </a>
                          <a href="add_category.php?delete=<?php echo $ss_id;?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                            <span class="glyphicon glyphicon-trash"></span>
                          </a>
                        </div>
                    </td>


                  </tr>


                <?php } ?>

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