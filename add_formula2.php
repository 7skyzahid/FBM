










<!-- 




DO   raw materil quantity values calulation with raw_material_purchase table 

through ajax request

for authenticate raw material quantity alert while selecting raw material in formula







 -->





















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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ADD FORMULA</i></b></h2><br>
</div>
<div class="row" >
<div class="col-md-6">
<div class="panel panel-default" >
<div class="panel-heading">
<strong>
<span class="glyphicon glyphicon-th"></span>
<span> New Formula</span>
<span class="pull-right hidden-xs">
<i class="fa fa-fw ti-angle-up clickable"></i>
<i class="fa fa-fw ti-close removepanel clickable"></i>
</span>
</strong>
</div>
<div class="panel-body">
<form method="post"  >
  <div class="row">
  <div class="col-md-4" > 
  <label><b> Formula  Name</b><span class="text-danger">*</span></label>
<input type="text" name="formulaname"  placeholder="Formula Name" class="form-control " required>
</div>

<div class="col-md-6  errors">
</div>
</div>
<br>
<br>

<div class="row" id="new_row">

<div class="col-md-12" id="row1">
    <input type="hidden" name="row[]" value="1" id="total_fields">

<div class="col-md-2">
      <label><b> Item Code</b><span class="text-danger">*</span></label>
<input type="text" id="code1" class="form-control input-sm" name="code[]"  placeholder="Code for Item" >
</div>

<div class="col-md-2">
 <label><b>  Name</b><span class="text-danger">*</span></label>
<select name="item[]" id="item1"  class="form-control input-sm select2" onchange ="get_product(1)">
  <option value="" > </option>
<?php

$items = mysqli_query($connection, "SELECT * FROM materials");
while ($row7=mysqli_fetch_array($items)) {
 $product_id=$row7['id'];
 $product_title=$row7['title'];
 echo '<option value="'.$product_id.'">'.$product_title.'</option>';


} ?>

</select>
</div>


<div class="col-md-2">
      <label><b> Price/KG</b><span class="text-danger">*</span></label>
<input type="text" id="price1" class="form-control input-sm" name="price[]"   placeholder="Price per Kilogram " required>
</div>

<div class="col-md-2">
      <label><b> KG/-</b><span class="text-danger">*</span></label>
<input type="text" id="quantity1" class="form-control input-sm" name="quantity[]"  onkeyup ="get_price(1)" placeholder="Quantity In KG/-" required>
</div>




<div class="col-md-2">
      <label><b> Total</b><span class="text-danger">*</span></label>
<input type="text" id="total1" class="form-control input-sm" name="total[]"  readonly>
</div>
                     
<div class="col-md-2">
<button type="button" onclick="add_row()" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50 add_btn">
<i class="icon fa fa-fw ti-plus" aria-hidden="true"></i></button>
</div>

 </div>  <!--   -->
       
</div>   <!-- <div class="row" id="new_row"> -->                         
<br>

<div class="col-md-3">
<label for="last_Name">Cost Per KG:</label>
<input class="form-control col-md-2" type="number" id="costperkg" name="costperkg"  value="0"  readonly>
</div>
<div class="col-md-3">
<label for="last_Name"> Total KG:</label>
<input class="form-control col-md-2" type="number" id="totalkg" name="totalkg"  value="0"  readonly>
</div>
<div class="col-md-3">
<label for="last_Name">Grand Total:</label>
<input class="form-control col-md-2" type="number" id="grand_total_amount" name="grand_total_amount"  value="0"  readonly>
</div>

<br><br>
 <div class="form-group form-actions">
<div class="col-md-6 col-md-offset-5">
<br>
<button type="submit" id="submit_btn" name="submit" class="button button-3d button-royal btn_3d sub">Add Formula</button>

</div>
</div>
  </form>
                
                    </div>
                
                </div>
            </div>






<div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Formulae</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Formula</th>
                    <th>Cost/KG</th>
                    <th>KG</th>
                    <th>Total</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1; 
                    $que1="SELECT * From formula_grand ";
                    $res1=mysqli_query($connection,$que1);
                    while ($row=mysqli_fetch_array($res1)) {
                    $proid=$row['formula_name'];


                    

                ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $row['formula_name'] ; ?></td>
                    <td><?php echo $row['costperkg'] ; ?></td>
                    <td><?php echo $row['grand_kg'] ; ?></td>
                    <td><?php echo $row['grand_amount'] ; ?></td>
                  
<!--                      `product_id`, `name`, `itemcode`, `quantity`, `price`, `total` -->
                    <td class="text-center">
                      <div class="btn-group">
                         <a href="view_formula.php?name=<?php echo $row['formula_name'];?>"  class="btn btn-xs btn-info" data-toggle="tooltip" title="View">
                          <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                              <!-- update_formula.php?gid=<?php echo $row['formula_name'];?> -->
                        <a href=""  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>

                        <a href="add_formula2.php?del=<?php echo $row['formula_name'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
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
</section>
</aside>
</div>

<script src="js/jquery.min.js"></script>
<script type="text/javascript">
  function get_product(id)
{
   var product=$('#item'+id).find(':selected').val();
    
        $.ajax({
        type : 'POST',
        url : 'add_formula_process.php',
        dataType:"json",
        data  : {product_id:product},
        success : function (data)
            {              
                 price=$('#price'+id).val(data.price);
            }
   });
}         
</script>
<script>
var count=0;
count=$('#total_fields').val();

    function add_row() {
        count++;

   $.ajax({
      url:'ajax_formula.php',
      
      type:'get',
      data:{'count':count},
      success(data){

      $('#new_row').append(data);
   }

   });
}


function get_price(id) {
var quantity=$('#quantity'+id).val();
var price=$('#price'+id).val();
$('#total'+id).val(price*quantity);
calculate_grand_total();
}
    

function calculate_grand_total()
        {
            var costper=0;
            var grand_total_amount = 0;
            var grand_total_kg= 0;
            $("input[name^='row']").each(function () {

               var total_amount_input = "#total" + $(this).val();
               grand_total_amount += parseInt($(total_amount_input).val());


               var total_kg_input = "#quantity" + $(this).val();
               grand_total_kg += parseInt($(total_kg_input).val());
            });

            Number($('#grand_total_amount').val(grand_total_amount));

            Number($('#totalkg').val(grand_total_kg));

        costper= grand_total_amount / grand_total_kg;




            Number($('#costperkg').val(costper.toFixed(3)));
        }


 function remove_item(id)
        {
            var div = '#row'+id;
            $(div).remove();
                calculate_grand_total();      }
</script>


<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("submit_btn").click();
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

<!-- begining of page level js -->
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





<?php 

     if(isset($_POST['submit'])){
          $formul=$_POST['formulaname'];       
          $grand=$_POST['grand_total_amount'];
          $tkg=$_POST['totalkg'];
          $costper=$_POST['costperkg'];
          $date=date('Y-m-d');
                                
$count=count($_POST['row']);
for ($i=0; $i<$count;$i++) { 

  // $qunt[$i]=(float)$_POST['quantity'][$i];

  //   echo $res[$i]  = $tkg/$qunt[$i]."<br>";
 $query5=" INSERT INTO `formula`(`formula_name`, `itemid`, `itemcode`, `quantity`, `price`, `total`)
VALUES('";
$query5.= $formul. "','"; 
$query5.=$_POST['item'][$i] . "','";
$query5.=$_POST['code'][$i] . "','";
$query5.=(float)$_POST['quantity'][$i] . "','";
$query5.=(float)$_POST['price'][$i] . "','";
$query5.=(float)$_POST['total'][$i] . "')";

   $result=mysqli_query($connection,$query5);
     
      }    


  $sql2="INSERT INTO `formula_grand` ( `formula_name`,`costperkg`, `grand_kg`, `grand_amount`)
  VALUES ('$formul','$costper','$tkg','$grand')";
   $insert=mysqli_query($connection,$sql2);

     
if($insert){
   echo' <script>window.location.href = "add_formula2.php";</script>';
}


   }

?>

<?php
if (isset($_GET['del'])) {
    $name=$_GET['del'];
$que2="DELETE FROM `formula` WHERE formula_name='$name'";
$res2=mysqli_query($connection,$que2);

$que3="DELETE FROM `formula_grand` WHERE formula_name='$name'";
$res3=mysqli_query($connection,$que3);






if($res2 && $res3){
   echo' <script>window.location.href = "add_formula2.php";</script>';
}
}?>


