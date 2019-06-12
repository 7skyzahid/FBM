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
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>



<aside class="right-side">
    <!-- Content Header (Page header) -->

  <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>PACKING PURCHASE </i></b></h2><br>
</div>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel "  style="margin-left:3%">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i>New Packing Purchase
                        </h3>
                        <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                    </div>
<div class="panel-body"  >
<form method="post" action="" >

<div class="row">
<div class="col-xs-3">
<label>Select Suppliers:</label>
<select name="supplier" id="supplier" onchange="get_product(1)"  class="form-control select2 " style="width:100%">
<option value="0">Choose</option>
    <?php
    $supplier = "SELECT * FROM suppliers";
   $run_supplier = mysqli_query($connection,$supplier);
   while ($row1=mysqli_fetch_array($run_supplier)) {?>
     <option  value="<?php echo $row1['id']; ?>"> <?php echo  $row1['name']; ?> </option>
  <?php } ?>
</select>                                                  
</div>
    
<div class="col-xs-3">
<label>Purchase Date:</label>
<input type="date"  name="purdate"  id="date"  value="<?php echo $todat=date('Y-m-d'); ?>" class="form-control" >
</div>

<!-- </div>
<div class="row">
 -->
<div class="col-xs-2">
<label>Bill No:</label>
<input type="text"  name="billno"  id="billno" class="form-control" >
</div>

<div class="col-xs-3">
<label>Bill Date:</label>
<input type="date"  name="billdate"  id="billdate" value="<?php echo $todat=date('Y-m-d'); ?>"  class="form-control" >
</div>

<div class="col-xs-1">
<label>Transport:</label>
<input type="checkbox"  name="transport"  id="transport" value="1" class="form-control">
</div>

</div><br><br>


<div class="row" id="new_row">
<div class="col-md-12" id="row1">
  <div  class="row" style="margin-left: 10px">
<input type="hidden"  name="row[]" value="1" id="total_fields">';

    <div class="col-xs-2">
        <label>Material:</label>
        <select name="product[]" id="pro1"  class="form-control select2" style="width:100%">
   <option value="0">Choose</option>
<?php

$items = mysqli_query($connection, "SELECT * FROM materials");
while ($row7=mysqli_fetch_array($items)) {
  $product_id=$row7['id']; 
 $product_title=$row7['title'];
 echo '<option value="'.$product_id.'">'.$product_title.'</option>';


} ?>
</select>                                                  
        </div>


    <div class="col-xs-2">
        <label>Packing:</label>
        <select name="packing[]" id="pack1"  class="form-control select2" style="width:100%">
   <option value="0">Choose</option>
<?php

$items = mysqli_query($connection, "SELECT * FROM pur_packing");
while ($row7=mysqli_fetch_array($items)) {
  $packid=$row7['id']; 
 $packname=$row7['pack_name'];
 echo '<option value="'.$packid.'">'.$packname.'</option>';


} ?>
</select>                                                  
        </div>        



<div class="col-xs-2">
<label>Price:</label>
<input type="text" name="pur_price[]" id="price1" class="form-control" >
</div>


<div class="col-xs-2">
<label>Discount ( % ) :</label>
<input type="text" name="discount[]" onkeyup="Caldiscount(1)" id="discount1" class="form-control" >
</div>

<div class="col-xs-2">
<label>Discount ( Val ):</label>
<input type="text"  name="cpdisc[]" onkeyup="Calcpdiscount(1)" id="cpdisc1" class="form-control"  >
</div>

<div class="col-xs-2">
<label>Bonus:</label>
<input type="text"  name="bonous[]"  id="bonous1" class="form-control" >
</div>


<input type="hidden" name="dumy1[]"  id="frstdumy1">
<input type="hidden" name="dumy2[]"  id="secdumy1">
<input type="hidden" name="prc[]"  id="prc1" class="form-control" readonly>

</div>


  <div  class="row" style="margin-left: 10px">
<div class="col-xs-2">
<label>Sale Tax:</label>
<input type="text" name="saletax[]" id="saletax1"   class="form-control" >
</div>


<div class="col-xs-2">
<label>Min Stock:</label>
<input type="text" name="minstock[]" id="minstock1"  class="form-control"  >
</div>

<div class="col-xs-2">
<label>Max Stock:</label>
<input type="text" name="maxstk[]" id="maxstk1"  class="form-control" >
</div>





<div class="col-xs-2">
<label>Quantity P:</label>
<input type="text" name="quantity[]" id="quantity1" onkeyup="changeQuantity(1)" class="form-control" >
</div>

<div class="col-xs-2">
<label>Quantity L:</label>
<input type="text" name="qnty_loss[]" id="lose1"  class="form-control" >
</div>

<div class="col-xs-2">
<label>Total Amount:</label>
<input type="text" name="total[]" id="total1" class="form-control" readonly >
</div>


<div class="col-xs-1">
<button type="button" onclick="add_row()" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50">
<i class="icon fa fa-fw ti-plus" aria-hidden="true"></i></button>
</div>

</div>
</div>
</div>
<hr><br>

<div class="row">
<div class="col-md-12">
<div class="col-xs-3">
<label>Total Amount:</label>
<input type="text" name="grand_total" id="grand_total_amount" class="form-control" readonly>
</div>

<div class="col-xs-3">
<label>Paid Amount:</label>
<input type="text" name="paid" id="paid" class="form-control" placeholder="Buyer Paid Amount">
</div>
<div class="col-xs-3">
<label>Due Amount:</label>
<input type="text" name="due" id="due" class="form-control" placeholder="Due Amount via Buyer" readonly>
</div>
</div>
</div>

<br><br>
<div class="form-group form-actions">
<div class="col-md-6 col-md-offset-5">
<button type="submit" name="save" id="save" class="button button-3d button-royal btn_3d sub">Save</button>
</div>
</div>



                    </form>
                </div>
<?php
 $date=date("Y-m-d");
if (isset($_POST['save'])) {
    $rand= (rand(1, 10000));
    
$count=count($_POST['row']);
for ($i=0; $i<$count;$i++) { 

(float)$qnty[$i]=(float)$_POST['bonous'][$i]+(float)$_POST['quantity'][$i];
  
$query="INSERT INTO ` raw_packing_purchase`( `product_id`, `pur_packing_id`, `supplier_id`, `pur_price`, `dis_percent`, `dis_value`, `bonus`, `saletax`, `min_stock_level`, `max_stock_level`, `quantity`, `qnty_loss`, `total_price`, `pur_date`, `bill_no`, `bill_date`, `transport`)

VALUES( '".$_POST['product'][$i]."','".$_POST['packing'][$i]."',
'".$_POST['supplier'][$i]."','".(float)$_POST['prc'][$i]."',
'".(float)$_POST['discount'][$i]."','".(float)$_POST['cpdisc'][$i]."',  
'".(float)$_POST['bonous'][$i]."','".(float)$_POST['saletax'][$i]."','".(float)$_POST['minstock'][$i]."',
'".(float)$_POST['maxstk'][$i]."','".(float)$_POST['quantity'][$i]."','".(float)$_POST['qnty_loss'][$i]."',
'".(float)$_POST['total'][$i]."','".$_POST['purdate']."','".$_POST['billno']."',
'".$_POST['billdate']."','".$_POST['transport']."')";

$result = mysqli_query($connection,$query);

} 

//  $supplier=$_POST['supplier'];
//  $summ=$_POST['grand_total'];
//  $paidd=$_POST['paid'];
//  $duee=$_POST['due'];
  
  
//  $pur_profit = 'Purchase';
//  $random = mt_rand(1,2000);
  
  
  
//   $profit = "INSERT INTO profit(purchase_id,name,debit,credit,created_date) values ('$random','$pur_profit','$paidd','$duee','$date') ";
//   $run_profit = mysqli_query($connection,$profit);


  
//  if ($duee>0) {
//  $query6=" INSERT INTO `purchase_amount`(`supplier_id`,profit_id,`grand_total`,`paid_amount`,`due_amount`,`status`,`created_at`) 
// VALUES ('$supplier','$random','$summ','$paidd','$duee','1','$date' )";
// $db6=mysqli_query($connection,$query6);
//  $last_id=mysqli_insert_id($connection);

//  }

// else {
// $query6=" INSERT INTO `purchase_amount`(`supplier_id`,profit_id,`grand_total`,`paid_amount`,`due_amount`,`status`,`created_at`) 
// VALUES ('$supplier','$random','$summ','$paidd','$duee','0','$date' )";
// $db6=mysqli_query($connection,$query6);
//  $last_id=mysqli_insert_id($connection);
// }

// if($db6){
// $query9=" INSERT INTO `purchase_dues_history`
// ( `purchase_amount_id`, `supplier_id`, `grand_total`, `paid_total`, `due`, `created_at`) 
// VALUES (  '$last_id','$supplier','$summ','$paidd','$duee','$date' )";
// $db9=mysqli_query($connection,$query9);
// }

if($result)
    {
      echo "<div style='margin-left:300px; padding:20px; text-align:center ' class=' col-md-5 bg-primary'>New Purchase Added </div>";
    }else
    {
     echo "<div style='margin-left:300px; padding:20px; text-align:center ' class=' col-md-5 bg-danger'>Something Went Wrong </div>";
    }


}
?>

            </div>
        </div>
    </div>
</section>
</aside>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $('.sub').attr('disabled','true');
 $('#supplier').after('<small id="notify" style="color:red;margin-left:50px;">Please select a supplier</small>');
if($('#supplier').change(function(){
var selected_supplier=$(this).find(':selected').val();
if(selected_supplier>0){
  $('.sub').removeAttr('disabled');
  $('#notify').remove();
    
}
else{
 $('.sub').attr('disabled','true');
  $(this).after('<small id="notify" style="color:red;margin-left:50px;">Please select a supplier</small>');

    
}
}));
  });
</script>

<script>
var count=0;
var count=$('#total_fields').val();
    function add_row() {
     $("#total_fields").val();
        count++;
   $.ajax({
      url:'ajax_purchase.php',
      type:'get',
      data:{'count':count},
      success(data){
      $('#new_row').append(data);
      }
   });
}
function changeQuantity(id)
{
var quantity=$('#quantity'+id).val();
var price=$('#prc'+id).val();
$('#total'+id).val(price*quantity);
calculate_grand_total();
}

function Caldiscount(id) {
var Nrmldisc=0;
var total1= $('#price'+id).val();
var discount=$('#discount'+id).val();
var after_minus=parseFloat((total1*discount)/100 );
  Nrmldisc =parseFloat(total1 - after_minus) ;
 $('#frstdumy'+id).val(Nrmldisc.toFixed(3));
}

function Calcpdiscount(id) { 
var Aftrdisc=0;
var total2= $('#frstdumy'+id).val();
var cpdisc=$('#cpdisc'+id).val();
   Aftrdisc =parseFloat(total2 - cpdisc);
 var sec=$('#secdumy'+id).val(Aftrdisc.toFixed(3));

var prc=$(sec).val();
var new_prc=$("#prc"+id).val(prc);
// var another=$(new_prc).val();


calculate_grand_total();
  }
 
function calculate_grand_total()
        {
          var id=$('#total_fields').val();
            var grand_total_amount = 0;
            $("input[name^='row']").each(function () {

                     var total_amount_input = "#total" + $(this).val();
                      grand_total_amount += Number($(total_amount_input).val());
            });
            Number($('#grand_total_amount').val(grand_total_amount.toFixed(3)));

    }
 function remove_item(id){
        var div = '#row'+id;
        $(div).remove();
        calculate_grand_total();
    }

$("#paid").keyup(function(){
var total= $('#grand_total_amount').val();
var paid=$('#paid').val();
 var due = total - paid;
 $('#due').val(due.toFixed(3));
  });
</script>
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




<script src="js/autosearch/bootstrap3-typeahead.min.js"></script> 
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>


</body>
</html>
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
