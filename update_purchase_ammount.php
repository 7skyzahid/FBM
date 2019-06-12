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
$que4="SELECT * FROM `purchase_amount` WHERE id='$Gid' ";
$res3=mysqli_query($connection,$que4);
while ($row=mysqli_fetch_array($res3)) {
        $date = $row['created_at'];
        $supp = $row['supplier_id'];
        $total = $row['grand_total'];
        $paid = $row['paid_amount'];
        $due = $row['due_amount'];
        $date = $row['created_at'];


        $select_name =  "SELECT * FROM  suppliers WHERE id='$supp'";
        $go = mysqli_query($connection,$select_name);
        while($row1=mysqli_fetch_array($go)){
        $name = $row1['name']; 

} } }?>
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
          <div class="row">
<div class="col-md-12">


<div class="col-md-6"><div class="form-group">
    <label><b>Supplier Name</b><span class="text-danger">*</span></label>
<input type="hidden" name="supp_id"  value="<?php echo $supp  ;?>" readonly>

<input type="text"  class="form-control input-sm" name="title" id="title"  value="<?php echo $name  ;?>" readonly>
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
<a href="dues_report_purchase.php" class="btn btn-danger btn-md ">CANCEL </a>
</div>


</div>
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
window.location.href = "dues_report_purchase.php";
}
};
</script>
<?php
$datenew=date("Y-m-d");
if (isset($_POST['save'])) {
         $oldpaid = $_POST['oldpaid'];
         $olddue =  $_POST['olddue'];
         $paidnew = $_POST['paidnew'];
         $duenew =  $_POST['duenew'];
         $paidfinal=$oldpaid+$paidnew;
        
        if($paidfinal==$total){

$query ="UPDATE `purchase_amount` SET `paid_amount`='$paidfinal',
`due_amount`='$duenew',`status`='0',`updated_at`='$datenew' WHERE id='$Gid' ";
    $result = mysqli_query($connection, $query);
        }
        else{
        $query ="UPDATE `purchase_amount` SET `paid_amount`='$paidfinal',
`due_amount`='$duenew',`status`='1',`updated_at`='$datenew' WHERE id='$Gid' ";
    $result = mysqli_query($connection, $query);
        }
        
        
$que5="SELECT * FROM `purchase_amount` WHERE id='$Gid' ";
$res4=mysqli_query($connection,$que5);
while ($row1=mysqli_fetch_array($res4)) {
  $profit_id = $row1['profit_id'];

  $que6="UPDATE profit SET debit = '$paidfinal', credit = '$duenew'  WHERE purchase_id='$profit_id' ";
  $res5=mysqli_query($connection,$que6);
}

        
        
        
        
        
        
    
$query2="INSERT INTO `purchase_dues_history`
(`purchase_amount_id`,`supplier_id`, `grand_total`, `paid_total`,`paid_new`, `due`, `created_at`)
 VALUES ('$Gid','$supp','$total','$paidfinal','$paidnew','$duenew','$datenew')";
    $result2 = mysqli_query($connection, $query2);
    
    
    if($result2){
    echo' <script>window.location.href = "dues_report_purchase.php";</script>';
    }
    


    //   $last_id = $connection->insert_id;
    // echo "<script>window.open('due_purchase_invoice.php?id=".$last_id."','_self')</script>";



   }
?>

