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
$que4="SELECT * FROM expense_cat WHERE id='$Gid' ";
$res3=mysqli_query($connection,$que4);
while ($row1=mysqli_fetch_array($res3)) {
   $ftitle = $row1['name'];
   
    // $fstatus = $row1['status'];
    
} } ?>
<section class="content">
<div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<div class="box-header with-border">
<div class="box-header with-border">
<h2 style="margin-left: 30%" class="font-weight-bold mb-1"><b> <i>UPDATE CATEGORY </i></b></h2><br>
</div>
   <div class="row"  style="margin-left:  15%">
   <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Category</span>
         </strong>
        </div>
<div class="panel-body">
  <form method="post" >
<div class="row"   >
<div class="col-md-12"><div class="form-group">
    <label><b>Name</b><span class="text-danger">*</span></label>
<input type="text" value="<?php echo $ftitle; ?>" class="form-control input-sm" name="title"  >
</div></div>
</div>


<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="expense_cat.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>

  </form>
  </div>
</div>
</div>

   </div>
</div>
  <script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "expense_cat.php";
}
};
</script>

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
<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    
  
$query5="UPDATE expense_cat SET name  ='$title' WHERE id='$Gid' "; 
    $result = mysqli_query($connection, $query5);
    // header("Location:category.php");
   
}


?>