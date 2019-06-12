<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php'; ?>
</head>

<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php'; ?>

<aside class="right-side">

    <section class="content">

 <div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<div class="box-header with-border">
<h2 align="center" class="font-weight-bold mb-1"><b> <i>PACKING  PURCHASE  TYPE</i></b></h2><br>
</div>
  <div class="row">
            <div class="col-md-5">
                <div class="panel " >
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i>Add New Purchase Packing Type 
                        </h3>
                        <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                    </div>
<div class="panel-body"  >
<form method="POST" action="">

<div class="col-md-6"><div class="form-group">
      <label><b>Packing Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="name"  placeholder="Enter Packing Name" required>
</div></div>

<div class="col-md-6"><div class="form-group">
  <label><b> Pack Size</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="size"  placeholder="Enter Packing Size" required>
  </div>
</div>

  <div class="col-md-12"><div class="form-group">
  <label><b>Pack Type</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="type"  placeholder="Enter Packing Type" required>
  </div>
</div>

<br>


<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="index.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>

</form>
</div>
<?php
if (isset($_POST['save'])) {
   
    $name = $_POST['name'];
    $size = $_POST['size'];
    $type = $_POST['type'];


$query ="INSERT INTO `pur_packing`( `pack_name`, `pack_size`, `pack_type`) VALUES ('$name','$size','$type')";
    $result = mysqli_query($connection, $query);
    if($result)
    {
      echo "<div style='margin-left:150px;padding:20px; text-align:center ' class=' col-md-5 bg-primary'>Packing Added</div>";
    }else
    {
      echo "Something wrong! ";
    }
  }
?>
</div>
</div>


  <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Purchase Packing Type </span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1; 
              $que1="SELECT * FROM `pur_packing`";
              $res1=mysqli_query($connection,$que1);
                  while ($row=mysqli_fetch_array($res1)) {
                    ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $row['pack_name'] ; ?></td>
                    <td><?php echo $row['pack_size'] ; ?></td>
                    <td><?php echo $row['pack_type'] ; ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="update_pur_packing.php?gid=<?php echo $row['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="add_pur_packing.php?id=<?php echo $row['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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
</div>
</section>
</aside>
</div>



<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>

<<script src="vendors/select2/js/select2.js" type="text/javascript"></script>
<script src="js/autosearch/bootstrap3-typeahead.min.js"></script> 
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>


<script type="text/javascript">
  $(document).ready(function(){

    $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


</script>
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
</body>
</html>

<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
$que2="DELETE FROM `pur_packing` WHERE id='$id'";
$res2=mysqli_query($connection,$que2);
if($res2){
   echo' <script>window.location.href = "add_pur_packing.php";</script>';
}
}?>