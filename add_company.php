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


<div>
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>COMPANY INFORMATION</i></b></h2><br>
</div>

<div class="col-md-6">
 <div class="panel" >
  <div class="panel-heading">
      <h3 class="panel-title">
          <i class="fa fa-fw ti-credit-card"></i> Total Companies
      </h3>
      <span class="pull-right">
          <i class="fa fa-fw ti-angle-up clickable"></i>
          <i class="fa fa-fw ti-close removepanel clickable"></i>
      </span>
  </div>
<div class="panel-body">
  <div class="row">
    <div class="col-md-6">
       <h3>Total Companies</h3>
    </div>
    <div class="col-md-6">
       <div class="text-center">
      <h3 class="text-dark"><b>
          <?php
          $product = "SELECT * FROM company";
          $run_pro = mysqli_query($connection,$product);
          $pro_total =  mysqli_num_rows($run_pro);
          echo $pro_total;
          ?>
      </b></h3>
     
  </div>
    </div>
  </div>
 

</div>
</div>
    <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Company</span>
             <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
         </strong>
         
        </div>
        <div class="panel-body">
          <form method="post" >
           <div class="row">
<div class="col-md-12">
<div class="col-md-12"><div class="form-group">
    <label><b>Title</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="title"  placeholder=" Company Name" >
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










    <div class="col-md-6">
 <div class="panel" >
  <div class="panel-heading">
      <h3 class="panel-title">
          <i class="fa fa-fw ti-credit-card"></i> All Companies List
      </h3>
      <span class="pull-right">
          <i class="fa fa-fw ti-angle-up clickable"></i>
          <i class="fa fa-fw ti-close removepanel clickable"></i>
      </span>
  </div>
        <div class="panel-body">
           <div class="panel ">
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Company</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1; 
              $que1="SELECT * FROM `company`";
              $res1=mysqli_query($connection,$que1);
                    while ($row=mysqli_fetch_array($res1)) {
                        ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $row['name'] ; ?></td>
                    <td class="text-center">
                      <div class="btn-group">
           <a href="update_company.php?gid=<?php echo $row['id'];?>" class="btn btn-xs btn-warning" 
              data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
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







</div>
</div>
</section>
</aside>
  


<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
$query ="INSERT INTO company (name)
VALUES ('$title')";
    $result = mysqli_query($connection, $query);
    if($result){
   echo' <script>window.location.href = "add_company.php";</script>';
}
   }
?>


<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<script src="js/app.js" type="text/javascript"></script>

<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>

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
