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

<!-- header logo: style can be found in header-->
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>

<aside class="right-side">
<section class="content">
<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>View Warehouse Transfer</i></b></h2><br>
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
                    <th>Date</th>
                    <th>Warehouse</th>
                    <th>Details</th>
                    <!-- <th>Action</th> -->
                 </tr>
                </thead>
                <tbody>

                <?php
                $serial  = 0;
                $query  =  "SELECT * FROM warehouse_transfers";;
                $run = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($run))
                {
                    $serial = $serial + 1; 
                    $ss_id = $row['id'];
                    $warehouse_transfer_date = $row['warehouse_transfer_date'];
                    $newDate = date("d-m-Y", strtotime($warehouse_transfer_date));
                    $warehouse_id = $row['warehouse_id'];
                   
                  ?>
                  <tr>
                    <td><?php echo $serial ; ?></td> 
                    <td><?php echo $newDate ; ?></td>
                    <td>
                        <?php
                        $select_w = "SELECT * FROM warehouses WHERE id = $warehouse_id";
                        $run_w = mysqli_query($connection,$select_w);
                        while($row= mysqli_fetch_array($run_w))
                        {
                           
                            $warehouse_name = $row['warehouse_name'];
                            echo $warehouse_name;
                        } 
                        ?>
                    </td>
                    
                   <td><button  onclick="show(<?php echo $ss_id; ?>)"   type="button" class="btn btn-primary btn1" data-toggle="modal" data-target="#grid_modal">Details</button></td>

                    <!-- <td class="text-center">
                        <br>
                        <div class="btn-group">
                          <a href="edit_wh_transfer.php?gid=<?php echo $ss_id ?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                            <span class="glyphicon glyphicon-edit"></span>
                          </a>
                          <a href="view_wh_transfer.php?delete=<?php echo $ss_id;?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                            <span class="glyphicon glyphicon-trash"></span>
                          </a>
                        </div>
                    </td> -->
                  </tr>
                <?php } ?>
                </tbody>
            </table>
<?php
if(isset($_GET['delete']))
{
    $de = $_GET['delete'];
    $del = "DELETE FROM warehouse_transfers WHERE id = $de ";
    $run_d = mysqli_query($connection,$del);
    $dell = "DELETE FROM warehouse_transfer_details WHERE warehouse_transfer_id = $de";
    $run_ddd =mysqli_query($connection,$dell);
    if($run_d && $run_ddd)
    {
        echo '<script>window.location.href="view_wh_transfer.php"</script>';
    }
}
?>

<div id="grid_modal" id="detail" class="modal fade animated" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">WareHouse Transfer Details</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="bg-primary">
                            <th>Finished Product</th>
                            <th>Packing</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="modal_detail">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close
            </button>
        </div>
    </div>
</div>
</div>

                            
        </div>
    </div>
</div>
</div>
</div>

<?php //include 'includes/right-menu.php' ?>
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
<script type="text/javascript" src="js/custom_js/advanced_modals.js"></script>

</body>
</html>
<script type="text/javascript">
function show(id)
{
    $.ajax({
        url:'process_tw_details.php',
        method:'GET',
        data:{id:id},
        success:function(data1)
        {
            $('#detail').modal('show');
            $('#modal_detail').html(data1);
        }
    });
}

document.onkeyup = function(e) {
if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
