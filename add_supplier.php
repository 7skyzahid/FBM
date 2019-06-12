<?php
include 'includes/db.php';
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


    <!-- Main content -->
    <section class="content">

        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >

<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>SUPPLIER INFORMATION</i></b></h2><br>
</div>
   <div class="row" >
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Supplier</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" >
          <div class="row">
<div class="col-md-12">

<div class="col-md-6"><div class="form-group">
    <label><b>Supplier Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="title"  placeholder="Supplier Name" >
</div></div>

<div class="col-md-6"><div class="form-group">
    <label><b>Contact Number</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="contact"  placeholder="Mobile/Phone" >
</div>
</div>

<div class="col-md-6"><div class="form-group">
    <label><b>Email Address</b><span class="text-danger">*</span></label>
<input type="email" class="form-control input-sm" name="email"  placeholder="Email Address" >
</div></div>

<div class="col-md-6"><div class="form-group">
    <label><b>Address</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="address"  placeholder="Address" >
</div></div>

<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="index.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>


</div>
</div>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Suppliers</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Supplier</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1; 
              $que1="SELECT * FROM `suppliers`";
              $res1=mysqli_query($connection,$que1);
                  while ($row=mysqli_fetch_array($res1)) {
                    ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $row['name'] ; ?></td>
                    <td><?php echo $row['contact'] ; ?></td>
                    <td><?php echo $row['email'] ; ?></td>
                    <td><?php echo $row['address'] ; ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="update_supplier.php?gid=<?php echo $row['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="add_supplier.php?id=<?php echo $row['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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

<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
$que2="DELETE FROM `suppliers` WHERE id='$id'";
$res2=mysqli_query($connection,$que2);
if($res2){
   echo' <script>window.location.href = "add_supplier.php";</script>';
}
}?>

<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
$query ="INSERT INTO `suppliers`(`name`, `contact`, `email`, `address`, `status`)
         VALUES  ('$title','$contact','$email','$address','1')";
    $result = mysqli_query($connection, $query);
    if($result){
   echo' <script>window.location.href = "add_supplier.php";</script>';
}
   }
?>


<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>
</html>
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
