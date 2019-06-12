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
$que4="SELECT * FROM `company` WHERE id='$Gid' ";
$res3=mysqli_query($connection,$que4);
while ($row1=mysqli_fetch_array($res3)) {
       $ftitle = $row1['name'];   
} } ?>
    <!-- Main content -->
    <section class="content">


        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<h2 style="margin-left: 25%" class="font-weight-bold mb-1"><b> <i>UPDATE COMPANY </i></b></h2><br>
</div>
   <div class="row" style="margin-left: 15%">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Company</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" >

<div class="col-md-12"><div class="form-group">
    <label><b>Title</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="title" value="<?php echo $ftitle;?>">
</div></div>


<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Update" class="btn btn-primary btn-md">
<a href="add_company.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>


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
window.location.href = "add_company.php";
}
};
</script>

<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $status = $_POST['status'];
    $desc = $_POST['desc'];
  
$query5="UPDATE `company` SET `name`='$title' WHERE id='$Gid' "; 
    $result = mysqli_query($connection, $query5);
    if($result){
   echo' <script>window.location.href = "add_company.php";</script>';
}
    // header("Location:category.php");
   
}


?>
