<?php
include 'includes/db.php';
?>
<?php
if (isset($_GET['gid'])) {
     $Gid=$_GET['gid'];

$query1="SELECT * FROM product WHERE id='$Gid'";
$conn=mysqli_query($connection,$query1);
while ($row1=mysqli_fetch_array($conn)) {
  

     $fproduct = $row1['title'];
     $fdesc = $row1['description'];
     $fminqnty = $row1['min_quantity'];
    
} 
 } ?>



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
<h2 style="margin-left: 20%" class="font-weight-bold mb-1"><b> <i>UPDATE PRODUCT </i></b></h2><br>
</div>
  <div class="row">
            <div class="col-lg-10">
                <div class="panel " >
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i> Update Product
                        </h3>
                        <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                    </div>
                    <div class="panel-body"  >
<form method="POST" enctype="multipart/form-data">


<div class="row" >
<div class="col-md-6"><div class="form-group">
      <label><b> Product Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="product"  value="<?php echo $fproduct ;?>" >
</div></div>

<div class="col-md-6"><div class="form-group">
  <label><b> Category</b><span class="text-danger">*</span></label>
<select name="category" class="form-control input-sm">
   <?php
   $query1="SELECT * FROM stock_categories";
   $db1=mysqli_query($connection,$query1);
   while ($row1=mysqli_fetch_array($db1)) {?>
     <option value="<?php echo $row1['id']; ?>"> <?php echo $row1['title']; ?> </option>
  <?php } ?>
    </select>
  </div>
</div>
</div>

<div class="row" >
<div class="col-md-6"><div class="form-group">
  <label><b>Unit </b><span class="text-danger">*</span></label>
<select name="unit" class="form-control input-sm">
      <option>Select Unit</option>
      <?php
   $queryx="SELECT * FROM units";
   $dbx=mysqli_query($connection,$queryx);
   while ($rowx=mysqli_fetch_array($dbx)) {?>
     <option value="<?php echo $rowx['id']; ?>"> <?php echo $rowx['title']; ?> </option>
   <?php } ?>
    </select>
  </div>
</div>
<div class="col-md-6"><div class="form-group">
  <label><b>Size </b><span class="text-danger">*</span></label>
<select name="size" class="form-control input-sm">
      <option>0</option>
      <?php
   $query3="SELECT * FROM sizes";
   $db3=mysqli_query($connection,$query3);
   while ($row3=mysqli_fetch_array($db3)) {?>
     <option value="<?php echo $row3['id']; ?>"> <?php echo $row3['title']; ?> </option>
   <?php } ?>
    </select>
  </div>
</div>
</div>
<div class="row" >
<div class="col-md-6"><div class="form-group">
  <label><b>Minimum Quantity </b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="minqnty" value="<?php echo $fminqnty ;?>" >
</div>
</div>
<div class="col-md-6"><div class="form-group">
  <label><b>Company </b><span class="text-danger">*</span></label>
<select name="company" class="form-control input-sm">
      <option>Select Company</option>
  <?php
   $query4="SELECT * FROM company";
   $db4=mysqli_query($connection,$query4);
   while ($row4=mysqli_fetch_array($db4)) {?>
     <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['name']; ?> </option>
   <?php } ?>
    </select>
  </div></div>
  <div class="col-md-6"><div class="form-group">
  <label><b>Description </b><span class="text-danger">*</span></label>
<input type="text"  name="desc" class="form-control input-sm" value="<?php echo $fdesc;?>" >
</div></div>


<div class="col-md-6"><div class="form-group">
    <label><b>Upload New  Image </b><span class="text-danger">*</span></label>
<input type="file"  name="userfile" class="form-control input-sm"   >
</div></div>
 </div>

<br>


<div  align="center">
<input type="submit" name="save" id="save" value="Update" class="btn btn-primary btn-md">
<a href="all_products.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>

</form>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</aside>
</div>


<?php
if (isset($_POST['save'])) {
   $target=basename($_FILES['userfile']['name']);
    $img=$_FILES['userfile']['name'];
    $product = $_POST['product'];
    $status = 10;
    $category = $_POST['category'];
    $unit = $_POST['unit'];
    $size = $_POST['size'];
    $minqnty = $_POST['minqnty'];
    $company = $_POST['company'];
    $desc = $_POST['desc'];
$query="UPDATE `product` SET `category_id`='$category',`title`='$product',`description`='$desc',`min_quantity`='$minqnty',
`unit_id`='$unit',`size_id`='$size',`image`='$img',`status`='$status',`company`='$company' WHERE id='$Gid'";
    $result = mysqli_query($connection, $query);
    move_uploaded_file($_FILES['userfile']['tmp_name'],$target );
   if($result){
   echo' <script>window.location.href = "all_products.php";</script>';
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
window.location.href = "all_products.php";
}
};
</script>
