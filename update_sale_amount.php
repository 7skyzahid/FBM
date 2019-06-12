<?php
include 'includes/db.php';?>
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
$que4="SELECT * FROM `stock_sales` WHERE id='$Gid' ";
$res3=mysqli_query($connection,$que4);
while ($row=mysqli_fetch_array($res3)) {
         // $id = $row['id'];
         $name = $row['customer'];
         $total = $row['discounted_amount'];
         $paid = $row['paid_amount'];
        $due = $row['due_amount'];
        $date = $row['created_date'];

 } }?>
    <!-- Main content -->
    <section class="content">

        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >

<div class="box-header with-border">
<h2 style="margin-left: 30%" class="font-weight-bold mb-1"><b> <i>UPDATE SUPPLIER  AMOUNT </i></b></h2><br>
</div>
   <div class="row"  style="margin-left:5%">
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Amount</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" >

<div class="col-md-6"><div class="form-group">
    <label><b>Patient Name</b><span class="text-danger">*</span></label>
<input type="hidden" name="supp_id"  value="<?php echo $supp  ;?>" readonly>

<input type="text"  class="form-control input-sm" name="title" id="title"  value="<?php echo $name;?>" readonly>
</div></div>

<div class="col-md-6"><div class="form-group">
    <label><b>Total Amount</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="total" id="total" value="<?php echo $total  ;?>" readonly>
</div>
</div>

<div class="col-md-6"><div class="form-group">
    <label><b>Last Paid Amount</b><span class="text-danger">*</span></label>
<input type="text" class="form-control input-sm" name="oldpaid" id="oldpaid" value="<?php echo $paid  ;?>" readonly >
</div></div>

  <div class="col-md-6"><div class="form-group">
  <label><b>Last Due Amount</b><span class="text-danger">*</span></label>
<input type="text" class="form-control input-sm" name="olddue" id="olddue"  value="<?php echo $due  ;?>" readonly>
  </div></div>

<div class="col-md-6"><div class="form-group">
    <label><b>date</b><span class="text-danger">*</span></label>
<input type="text" class="form-control input-sm" name="date" id="date"  value="<?php echo $date  ;?>" readonly>
</div></div>

 <div class="col-md-6"><div class="form-group">
  <label><b>Upload Image </b><span class="text-danger">*</span></label>
<input type="file"  name="userfile" class="form-control input-sm">
</div></div>

<div class="col-md-6"><div class="form-group">
    <label><b>Pay New </b><span class="text-danger">*</span></label>
<input type="text" class="form-control input-sm" name="paidnew" id="paidnew"  >
</div></div>

  <div class="col-md-6"><div class="form-group">
  <label><b> Due New </b><span class="text-danger">*</span></label>
<input type="text" class="form-control input-sm" name="duenew" id="duenew"  readonly>
  </div></div>

 

<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Update" class="btn btn-primary btn-md">
<a href="dues_report_sales.php" class="btn btn-danger btn-md ">CANCEL </a>
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
<script type="text/javascript">
  $("#paidnew").keyup(function(){
var dueold= $('#olddue').val();
var paid=$('#paidnew').val();
 var due = dueold - paid;
 $('#duenew').val(due);
  });
</script>
</script>
</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "dues_report_sales.php";
}
};
</script>
<?php
$datenew=date("Y-m-d");
if (isset($_POST['save'])) {
         
          $oldpaid = $_POST['oldpaid'];
          $paidnew = $_POST['paidnew'];
        $duenew = $_POST['duenew'];
        $paidfinal=$oldpaid+$paidnew;
        
        
        if($paidfinal==$total){

$query ="UPDATE `stock_sales` SET `paid_amount`='$paidfinal',
`due_amount`='$duenew',`status`='0',`updated_at`='$datenew' WHERE id='$Gid' ";
    $result = mysqli_query($connection, $query);
        }
        else{
$query ="UPDATE `stock_sales` SET `paid_amount`='$paidfinal',
`due_amount`='$duenew',`status`='1',`updated_at`='$datenew' WHERE id='$Gid' ";
    $result = mysqli_query($connection, $query);
}


$que5="SELECT * FROM `stock_sales` WHERE id='$Gid' ";
$res4=mysqli_query($connection,$que5);
while ($row1=mysqli_fetch_array($res4)) {
         
  $profit_id = $row1['profit_id'];
  $que6="UPDATE profit SET debit = '$duenew', credit = '$paidfinal'  WHERE sale_id ='$profit_id' ";
  $res5=mysqli_query($connection,$que6);
         
} 




    $query2="INSERT INTO `sales_due_history`(`stock_sales_id`,`customer`,`grand`,`paid_total`,`paid_new`,`due`, `created_date`)
 VALUES ('$Gid','$name','$total','$paidfinal','$paidnew','$duenew','$datenew')";
    $result2 = mysqli_query($connection, $query2);

   if($result2){
       
    echo' <script>window.location.href = "dues_report_sales.php";</script>';
    }



   }
?>




 <!-- <script type="text/javascript">
              document.onkeyup = function(e) {

         if (e.which == 27) {
            window.location.href = "dashboard.php";
              }

            };
            </script> -->