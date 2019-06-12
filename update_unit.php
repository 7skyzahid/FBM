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
  
<?php
if (isset($_GET['gid'])) {
    $Gid=$_GET['gid'];
$que4="SELECT * FROM `units` WHERE id='$Gid' ";
$res3=mysqli_query($connection,$que4);
while ($row1=mysqli_fetch_array($res3)) {
    $ftitle = $row1['title'];
     $id = $row1['id'];
    
} } ?>

    <!-- Main content -->
  <div class="box-header with-border" >
<h2 style="margin-left: 30%" class="font-weight-bold mb-1"><b> <i>UPDATE UNIT </i></b></h2><br>
</div>
   <div class="row" style="margin-left: 15%">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Unit</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" >
            <div class="form-group">
               <input type="text" class="form-control" name="title" value="<?php echo $ftitle; ?>" >
            </div>
            <input type="submit" name="save" id="save" value="Update Unit" class="btn btn-primary">
           <a href="add_unit.php" class="btn btn-danger btn-md ">CANCEL </a>
        </form>
        </div>
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
</body>
</html>

<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "add_unit.php";
}
};
</script>
<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $status = $_POST['status'];
    $desc = $_POST['desc'];
  
$query5="UPDATE `units` SET `title`='$title' WHERE id='$Gid' "; 
    $result = mysqli_query($connection, $query5);
        if($result){
   echo' <script>window.location.href = "add_unit.php";</script>';
}
    // header("Location:category.php");
   
}


?>



