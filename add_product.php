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

    <section class="content">

 <div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<div class="box-header with-border">
<h2 style="margin-left: 20%" class="font-weight-bold mb-1"><b> <i>ADD RAW MATERIAL</i></b></h2><br>
</div>
  <div class="row">
            <div class="col-lg-10">
                <div class="panel " >
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i> Add Raw Materials Information
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
      <label><b> Material Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-md" name="product"  placeholder="Name of Prduct" required>
</div></div>

<div class="col-md-6"><div class="form-group">
  <label><b> Category</b><span class="text-danger">*</span></label>
<select name="category" class="form-control input-md select2 " required>
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
<select name="unit" class="form-control input-md select2 ">
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
<select name="size" class="form-control input-md">
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


 <div class="col-md-6">
  <div class="form-group">
    <label><b>Chose Company </b><span class="text-danger">*</span></label>
<select name="company" id="select2" class="form-control select2 " required>
         <option value="">Choose</option>
          <optgroup >
              <?php
               $query4="SELECT * FROM company";
               $db4=mysqli_query($connection,$query4);
               while ($row4=mysqli_fetch_array($db4)) {?>
                 <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['name']; ?> </option>
               <?php } ?> 
          </optgroup> 
      </select>
  </div>

</div>



  <div class="col-md-6"><div class="form-group">
  <label><b>Description </b><span class="text-danger">*</span></label>
<input type="text"  name="desc" class="form-control input-md"  placeholder="Some Extra Information of Product " >
</div></div>
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
    $product = $_POST['product'];
    $category = $_POST['category'];
    $unit = $_POST['unit'];
    $size = $_POST['size'];
    $company = $_POST['company'];
    $desc = $_POST['desc'];
    

$query ="INSERT INTO `materials`
(  `category_id`, `title`, `description`, `unit_id`, `size_id`, `company`)
VALUES ('$category','$product','$desc','$unit','$size','$company')";
    $result = mysqli_query($connection, $query);
    if($result)
    {
      echo "<div style='margin-left:250px;padding:20px; text-align:center ' class=' col-md-5 bg-primary'>Product Added </div>";
    }else
    {
      echo "Something wrong! ";
    }
  }
?>
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

<script src="vendors/select2/js/select2.js" type="text/javascript"></script>
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

