<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php'; ?>
</head>
<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php include 'includes/menu.php'; ?>

<aside class="right-side">
    <section class="content">
        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i> PACKAGE SALE</i></b></h2><br>
</div>
<div class="row" >
<div class="col-md-12">
<div class="panel panel-default" >
<div class="panel-heading">
<strong>
<span class="glyphicon glyphicon-th"></span>
<span> New Package Sale</span>
<span class="pull-right hidden-xs">
<i class="fa fa-fw ti-angle-up clickable"></i>
<i class="fa fa-fw ti-close removepanel clickable"></i>
</span>
</strong>
</div>
<div class="panel-body">
<form method="post" action="add_package_sales.php" >
<div class="row">
<div class="col-md-4" > 
  <label>Enter Patient Name:</label>
<input type="text" name="patient"  placeholder="Patient Name" class="form-control ">
</div>

<div class="col-md-4">
<label>Select Package:</label>
<select  id="packageid" name="package_id"  onchange ="get_product()" class="form-contro0l select2" style="width:100%">
   <option value="0">Choose Package</option>
<?php
$run_items = mysqli_query($connection,"SELECT DISTINCT(name), package.package_id, package.name FROM package ");
while ($row1=mysqli_fetch_array($run_items)) {   
 echo '<option value="'.$row1['package_id'].'">'  .$row1['name'].  '</option>';
} ?>
</select>                                                  
</div>
</div><br>
<div class="row">
<div class="col-md-2">
    <label for="last_Name">Grand:</label>
    <input type="text" name="grand" id="grand" class="form-control">
</div>

<div class="col-md-2">
    <label for="last_Name">Discount:</label>
    <input type="text" name="discount"   id="discount"  class="form-control qty">
</div>

<div class="col-md-2">
<label>After Discount:</label>
<input type="text" name="afdisc" readonly id="afdisc" class="form-control">
</div>

    <div class="col-md-2">
<label>Paid Amount:</label>
<input type="text" name="paid" id="paid" class="form-control">
</div>
<div class="col-md-2">
<label>Due Amount:</label>
<input type="text" name="due" readonly id="due" class="form-control">
</div>

 </div>     


<div class="col-md-12" style="margin-top: 20px;">
<button type="submit" id="submit_btn" name="submit" class="button button-3d button-royal btn_3d sub" style="margin-left: 10%">Sale Package</button>
</div>


                </form>
        
            </div>
        
        </div>
    </div>
</div>
</div>
</section>
</aside>
</div>

<script src="js/jquery.min.js"></script>
<?php include 'includes/right-menu.php' ?>
</div>
<script src="js/app.js" type="text/javascript"></script>
<script src="js/custom_js/form_layouts.js" type="text/javascript"></script>
<script src="vendors/iCheck/js/icheck.js" type="text/javascript"></script>
<script src="vendors/select2/js/select2.js" type="text/javascript"></script>
<script type="text/javascript" src="vendors/Buttons/js/buttons.js"></script>
<script type="text/javascript" src="vendors/laddabootstrap/js/spin.min.js"></script>
<script type="text/javascript" src="vendors/laddabootstrap/js/ladda.min.js"></script>
<script type="text/javascript" src="js/custom_js/button_main.js"></script>
<script>
  $(document).ready(function () {
        $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
    });

</script>
</body>
</html>
<script type="text/javascript">
$("#discount").keyup(function(){
var total= $('#grand').val();
var disc=$('#discount').val();
 aftdisc=total - ( total*disc/100 );
$('#afdisc').val(aftdisc);
$('#paid').val(aftdisc);
var aftrdic=$('#afdisc').val();
var paid=$('#paid').val();
    

$('#due').val(aftrdic-paid);
});




$("#paid").keyup(function(){
var paid1=$('#paid').val();
var aftrdic2=$('#afdisc').val();
var sum= aftrdic2-paid1;
$('#due').val(sum);


});

</script>

<script type="text/javascript">
  
function get_product()
{

   var product=$('#packageid').find(':selected').val();
        $.ajax({
        type : 'POST',
        url : 'ajax_package_sale.php',
        dataType:"json",
        data  : {"package_id":product},
        success : function (data)
            {

         var grnad=$('#grand').val(data.grand);
           

            }
});
      }
</script>

<?php 

if(isset($_POST['submit'])){
$gid=$_POST['package_id'];

$grand=$_POST['grand'];
$discount=$_POST['discount'];
$discounted_amount=$_POST['afdisc'];
$paid_amount=$_POST['paid'];
$due_amount=$_POST['due'];
$customer=$_POST['patient'];

$created_date=date('Y-m-d');

if ($due_amount>0) {
 $sql="INSERT INTO `stock_sales`( `customer`, `grand_total_amount`, `discount`, `discounted_amount`, 
                                  `paid_amount`, `due_amount`, `created_date`, `updated_at`, `status`)
VALUES ('$customer','$grand','$discount','$discounted_amount','$paid_amount','$due_amount','0','$created_date','1')";
$res=mysqli_query($connection,$sql);

}

else{

 $sql="INSERT INTO `stock_sales`( `customer`, `grand_total_amount`, `discount`, `discounted_amount`, 
                                  `paid_amount`, `due_amount`, `created_date`, `updated_at`, `status`)
  VALUES ('$customer','$grand','$discount','$discounted_amount','$paid_amount','$due_amount','0','$created_date','0')";
  $res=mysqli_query($connection,$sql);

}
$last_id=mysqli_insert_id($connection);

if ($res) {
  $sql2="INSERT INTO `package_sale`(`stock_sale_id`,`patient`,`package_id`,`created_at`) 
                     VALUES ('$last_id','$customer','$gid','$created_date')";
  $insert=mysqli_query($connection,$sql2);

if ($res) {
 $cus_profit = "Sales";
            $profit = "INSERT INTO profit(name,debit,credit,created_date) values ('$cus_profit','$due_amount','$paid_amount','$created_date') ";
            $run_profit = mysqli_query($connection,$profit);
                                
       }                



         
}


}
 
?>
