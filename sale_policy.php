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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>SALE POLICY</i></b></h2><a class="btn btn-primary" href="add_sale_policy.php">Add New</a> <br>
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Code</th>
                        <th>Bonus</th>
                        <th>Extras</th>
                                                 
                    </tr>
                  </thead>
            <tbody>
             <?php
                $serial = 0;
                $select_expense = "SELECT * FROM sale_policies";
                $run_exp = mysqli_query($connection,$select_expense);
                while($row= mysqli_fetch_array($run_exp))
                {
                    $serial =$serial +1;
                    $id1 = $row['id'];
                    $policy_name = $row['policy_name'];
                    $description = $row['description'];
                    $code = $row['code'];
                    $bonus = $row['bonus'];
                    $extra = $row['extra'];

                   
                    // $date = $row['created_at'];
                    // $newDate = date("d-m-Y", strtotime($date));
            ?>
            <tr>
                <td><?php echo $serial; ?></td>
              
                <td><?php echo $policy_name; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $code; ?></td>
                <td><?php echo $bonus; ?></td>
                
                <td><?php echo $extra; ?></td>

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