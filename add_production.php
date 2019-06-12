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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ADD PRODUCTION INFORMATION</i></b></h2><br>
</div>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel " >
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i> Add New Production
                        </h3>
                        <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                    </div>
<div class="panel-body"  >
<form method="post" action="" >

<div class="row" >
<div class="col-md-12">


  <div class="row" >
<div class="col-md-12">
  <div class="col-md-12  errors">
  </div>

</div>
</div>



  <div  class="row" style="margin-left: 20px">

    <div class="col-xs-4">
        <label>Formula:</label>
        <select name="formula" id="formula"   class="form-control select2" >
   <option value="0">Choose Formula</option>
<?php
$items = mysqli_query($connection, "SELECT * FROM formula_grand");
while ($row7=mysqli_fetch_array($items)) {
  $for_id=$row7['id']; 
  $formula_name=$row7['formula_name'];
  $costperkg=$row7['costperkg']; 
  $grand_formula=$row7['grand_amount']; 
  $qnty_formula=$row7['grand_kg']; 

  
 echo '<option value="'.$for_id.'">'.$formula_name.'</option>';} ?>
</select>                                                  
        </div>

<div class="col-xs-4">
<label>Quantity:</label>
<input type="text" name="qnty" id="qnty"   class="form-control" placeholder="Quantity" >
</div>

<input type="hidden" name="hide" id="hide">
</div>
</div>
</div>

<br>
<div class="row" id="new_row">
<div class="col-md-12" id="row1">
<div  class="row" style="margin-left: 20px">
<input type="hidden"  name="row[]" value="1" id="total_fields">


 <div class="col-xs-4">
        <label>Employee:</label>
        <select name="employee[]" id="employee1"   class="form-control select2" >
   <option value="">Choose Employee</option>
<?php
$items = mysqli_query($connection, "SELECT * FROM employees");
while ($row7=mysqli_fetch_array($items)) {
  $emp_id=$row7['id']; 
 $empl=$row7['name'];
 echo '<option value="'.$emp_id.'">'.$empl.'</option>';} ?>
</select>                                                  
        </div>

<div class="col-xs-4">
<label>Quantity:</label>
<input type="text" name="quantity[]" id="quantity1"  class="form-control"  placeholder="Quantity">
</div>


<div class="col-xs-1">
<button type="button" onclick="add_row()" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50">
<i class="icon fa fa-fw ti-plus" aria-hidden="true"></i></button>
</div>

</div>
</div>
</div>
<hr><br>

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
    $formula_id=$_POST['formula'];
    $qnty=$_POST['qnty'];
// calculation for poroduct_production table 
// total_kg (   entered quantity * formula grand_kg )
 $prodfinQnty=$qnty*$qnty_formula;
// grand_amount   (   entered quantity * formula grand_amount )
 $prodfinAmount=$qnty*$grand_formula;


$query = " SELECT * FROM formula  WHERE formula_name='$formula_name' ";
  $result= mysqli_query($connection,$query);

while ($fetch=mysqli_fetch_array($result)) {
    $formu_item_id=$fetch['itemid'];
    $formu_item_qnty=$fetch['quantity'];
    
// claculate ecah raw material quantity in production 
    $rawQnty= $qnty * $formu_item_qnty;


$query1 = " SELECT * FROM raw_material_purchase  WHERE product_id='$formu_item_id' ";
  $result1= mysqli_query($connection,$query1);

while ($fetch1=mysqli_fetch_array($result1)) {
     $rawfinqnty=$fetch1['quantity'];

if ( $rawQnty > $rawfinqnty ) {


      echo "<div style='margin-left:200px; padding:20px; text-align:center' class=' col-md-8 bg-danger'> 
      
Production Can Not be Done As  Raw Material Quantity Is Less In Stock Than Desired Quantity

       </div>";
    
}


else{
$query2 = " UPDATE  raw_material_purchase SET quantity=(quantity - $rawQnty)  WHERE product_id='$formu_item_id' ";
  $result2 = mysqli_query($connection,$query2);






 $query3 = "INSERT INTO `products_production`(rand,formula_id,quantity,costperqnty,grand_amount,total_kg,created_at) 
  VALUES ('$rand','$formula_id','$qnty','$costperkg','$prodfinAmount','$prodfinQnty','$date') ";
  $result3 = mysqli_query($connection,$query3);


$count=count($_POST['row']);
for ($i=0; $i<$count;$i++) { 
  
$query4="INSERT INTO employee_productions (rand,emp_id,emp_qnty,created_at)
VALUES( '".$rand."','".$_POST['employee'][$i]."','".$_POST['quantity'][$i]."','".$date."')";

$result4 = mysqli_query($connection,$query4);

} 


} // check the loop here while there are multiple raw materials in a formula chek the insertion behavior if so 
   // write else contion out of while loop body




 } 


}    


if($result4)
    {

      echo "<div style='margin-left:300px; padding:20px; text-align:center' class=' col-md-5 bg-primary'>New Production Added </div>";
    }

}
?>


            </div>
        </div>
    </div>
</section>
</aside>
<script src="js/jquery.min.js"></script>

<script>
var count=0;
var count=$('#total_fields').val();
    function add_row() {
     $("#total_fields").val();
        count++;
   $.ajax({
      url:'ajax_production.php',
      type:'get',
      data:{'count':count},
      success(data){
      $('#new_row').append(data);
      }
   });
}

 function remove_item(id){
        var div = '#row'+id;
        $(div).remove();
    }

  $(document).ready(function(){

    $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "index.php";
}
};
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
var yes="yes";  
var no="no";
$( '#qnty' ).keyup(function() {

var req_quantity=parseInt($(this).val());
var req_quantit=$('#qnty').val();


var formula_id=$('#formula').find(':selected').val();

        $.ajax({
        type : 'POST',
        url : 'ajax_production_qnty.php',
        dataType:"json",
        data: { formula:formula_id , quantity : req_quantity},
        success : function (data)
            {

                var resp=$('#hide').val(data.ans);
                var req=$('#hide').val();
       

// console.log(resp);
              
if(req==no){

         $('.errors').html('<small id="id" class="help-block"  style="color:#ff6666;margin-left:250px;"> Production Can Not be Done As  Raw Material Quantity Is Less In Stock Than Desired Quantity  </small>')

}


else{
     $(".errors").html('');
}

}

});

});







</script>



<?php
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







// $query2 = " UPDATE formula_grand SET grand_kg=(grand_kg - $qnty)  WHERE id='$formula' ";
//   $result2 = mysqli_query($connection,$query2);

?>