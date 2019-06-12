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
<h2 style="margin-left: 20%" class="font-weight-bold mb-1"><b> <i>ADD NEW EMPLOYEE</i></b></h2><br>
</div>
  <div class="row">
            <div class="col-lg-10">
                <div class="panel " >
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i> Add New Employee Information
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
      <label><b> Employee Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="empname"  placeholder="Name of Employee" required>
</div></div>

<div class="col-md-6"><div class="form-group">
  <label><b>Select  Employee Type</b><span class="text-danger">*</span></label>
<select name="emptype" class="form-control input-sm select2" required>
   <?php
   $query1="SELECT * FROM employee_types";
   $db1=mysqli_query($connection,$query1);
   while ($row1=mysqli_fetch_array($db1)) {?>
     <option value="<?php echo $row1['id']; ?>"> <?php echo $row1['type']; ?> </option>
  <?php } ?>
    </select>
  </div>
</div>
</div>

<div class="row" >
<div class="col-md-6"><div class="form-group">
  <label><b>Department </b><span class="text-danger">*</span></label>
<select name="empdept" class="form-control input-sm select2" required> 
      <option>Select Department</option>
      <?php
   $queryx="SELECT * FROM departments";
   $dbx=mysqli_query($connection,$queryx);
   while ($rowx=mysqli_fetch_array($dbx)) {?>
     <option value="<?php echo $rowx['id']; ?>"> <?php echo $rowx['type']; ?> </option>
   <?php } ?>
    </select>
  </div>
</div>
<div class="col-md-6"><div class="form-group">
  <label><b>Salary </b><span class="text-danger">*</span></label>
<select name="empsalary" class="form-control input-sm select2" required>
      <option>Select Salary</option>
      <?php
   $query3="SELECT * FROM salaries";
   $db3=mysqli_query($connection,$query3);
   while ($row3=mysqli_fetch_array($db3)) {?>
     <option value="<?php echo $row3['id']; ?>"> <?php echo $row3['type']; ?> </option>
   <?php } ?>
    </select>
  </div>
</div>
</div>
<div class="row" >
<div class="col-md-6"><div class="form-group">
  <label><b>Father Name: </b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="father"  placeholder="Enter Father Name"  >
</div>
</div>

  <div class="col-md-6"><div class="form-group">
  <label><b>Birth Date: </b><span class="text-danger">*</span></label>
<input type="date"  name="dob" class="form-control input-sm"   >
</div></div>


<div class="col-md-6"><div class="form-group">
    <label><b>CNIC </b><span class="text-danger">*</span></label>
<input type="text"  name="cnic" class="form-control input-sm"  placeholder="Enter CNIC "  >
</div></div>

  <div class="col-md-6"><div class="form-group">
  <label><b>Mobile N0: </b><span class="text-danger">*</span></label>
<input type="text"  name="mobile" class="form-control input-sm"  placeholder="Mobile Number" >
</div></div>


<div class="col-md-12"><div class="form-group">
    <label><b>Address: </b><span class="text-danger">*</span></label>
<input type="text"  name="add" class="form-control input-sm"  placeholder="Address of the Employee "  >
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
$date=date('Y-m-d');
if (isset($_POST['save'])) {
   
    $type = $_POST['emptype'];
    $name = $_POST['empname'];
    $father  = $_POST['father'];
    $dob  = $_POST['dob'];
    $cnic  = $_POST['cnic'];
    $mobile  = $_POST['mobile'];
    $add  = $_POST['add'];
    $deptt  = $_POST['empdept'];
    $salary  = $_POST['empsalary'];
    

$query ="INSERT INTO 
`employees`(`type`, `entry_date`, `name`, `father`, `birth`, `cnic`, `mobile`, `address`, `deptt`, `salary`)
VALUES ('$type','$date','$name','$father','$dob','$cnic','$mobile','$add','$deptt','$salary')";
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

