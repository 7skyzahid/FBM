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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>ADD PACKAGE</i></b></h2><br>
</div>
<div class="row" >
<div class="col-md-12">
<div class="panel panel-default" >
<div class="panel-heading">
<strong>
<span class="glyphicon glyphicon-th"></span>
<span> New Package</span>
<span class="pull-right hidden-xs">
<i class="fa fa-fw ti-angle-up clickable"></i>
<i class="fa fa-fw ti-close removepanel clickable"></i>
</span>
</strong>
</div>
<div class="panel-body">
<form method="post" action="add_package.php" >
  <div class="col-md-4" > 
<input type="text" name="packagename"  placeholder="Package Name" class="form-control ">
</div>

<div class="col-md-6  errors">
</div>
<br>

<div class="row" id="new_row">

<div class="col-md-12" id="row1">
    <input type="hidden" name="row[]" value="1" id="total_fields">
    <div class="col-md-3">
        <label for="last_Name">Select:</label>
        <select  id="product1" onchange="get_product(1)" name="product_id[]" class="form-contro0l select2" style="width:100%">
   <option value="0">Choose</option>
<?php

$run_items = mysqli_query($connection,"SELECT DISTINCT(product_id) 
      FROM stock_items 
      LEFT join product on 
      stock_items.product_id=product.id
      WHERE quantity>0
      ORDER by expiry_date ASC");
while ($row1=mysqli_fetch_array($run_items)) {
 $product_id=$row1['product_id']; 
   



$items = mysqli_query($connection,"SELECT * FROM product WHERE id='$product_id'");
$row2=mysqli_fetch_array($items);

 $product_id=$row2['id']; 
 $product_title=$row2['title'];
 echo '<option value="'.$product_id.'">'.$product_title.'</option>';


} ?>
</select>                                                  
        </div>

<div class="col-md-2">
    <label for="last_Name">Price:</label>
    <input type="text" name="price[]" id="price1" class="form-control">
</div>

<div class="col-md-2">
    <label for="last_Name">Qunatity:</label>
    <input type="number" name="quantity[]" required   id="quantity1"  class="form-control qty">
</div>

      <div class="col-md-2">
    <label  for="last_Name">Total:</label>
    <input type="text" name="total[]" id="total1" class="form-control">
</div>
                     
<div class="col-md-2">
<button type="button" onclick="add_row()" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50 add_btn">
<i class="icon fa fa-fw ti-plus" aria-hidden="true"></i></button>
</div>

 </div>  <!--   -->
       
</div>   <!-- <div class="row" id="new_row"> -->                         
<br>

<div class="col-md-3">
<label for="last_Name">Grand Total:</label>
<input class="form-control col-md-2" type="number" id="grand_total_amount" name="grand_total_amount"  value="0"  readonly>
</div>
<br><br>
 <div class="form-group form-actions">
<div class="col-md-6 col-md-offset-5">
<br>
<button type="submit" id="submit_btn" name="submit" class="button button-3d button-royal btn_3d sub">Add Package</button>

</div>
</div>
  </form>
                
                    </div>
                <?php 

     if(isset($_POST['submit'])){
                       
                                $grand=$_POST['grand_total_amount'];
                                $created_date=date('Y-m-d');
                                
 $sql="INSERT INTO `package_amount`(`grand`, `created_at`)
  VALUES ('$grand','$created_date')";
   $result=mysqli_query($connection,$sql);
                       
                           $last=mysqli_insert_id($connection);
                             
                               $count=count($_POST['row']);

                            $package=$_POST['packagename'];
                            
                              for ($i=0;$i<$count;$i++) {
                               $pro_id[$i]=$_POST['product_id'][$i];
                               $pro_quant[$i]=$_POST['quantity'][$i];
                               $price[$i]=$_POST['price'][$i];
                               $pro_tot[$i]=$_POST['total'][$i];
                              

  $sql2="INSERT INTO `package`(  `package_id`, `name`, `products`, `price`, `quantity`, `total`) 

  VALUES ('$last','$package','$pro_id[$i]','$price[$i]','$pro_quant[$i]','$pro_tot[$i]')";
                               $insert=mysqli_query($connection,$sql2);

                                     
                       }
                       
                       
                       if($insert)
    {
      echo "<div style='margin-left:300px; padding:20px; text-align:center ' class=' col-md-5 bg-primary'>New Package Added </div>";
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
</section>
</aside>
</div>

<script src="js/jquery.min.js"></script>
<script>
var count=0;
count=$('#total_fields').val();

    function add_row() {
        count++;

   $.ajax({
      url:'ajax_package.php',
      
      type:'get',
      data:{'count':count},
      success(data){

      $('#new_row').append(data);
   }

   });
}

function calculate_grand_total()
        {
            var grand_total_amount = 0;
            $("input[name^='row']").each(function () {
               var total_amount_input = "#total" + $(this).val();
               grand_total_amount += parseInt($(total_amount_input).val());


            
            });

            Number($('#grand_total_amount').val(grand_total_amount));


        }

function get_product(id)
{



   var product=$('#product'+id).find(':selected').val();

        var total=0;
    
        $.ajax({
        type : 'POST',
        url : 'add_sales_process.php',
        dataType:"json",
        data  : {product_id:product},
        success : function (data)
            {

              
               var price=0;
               var quantity=0;

                 price=$('#price'+id).val(data.price);

                 var net_price=parseInt($(price).val());
                 console.log(net_price);      
                 quantity=Number($('#quantity'+id).val(1));

                $('#stock_item_id'+id).val(data.id);
                var single=$('#single_quantity'+id).val(data.quantity);
                 
                 var single_quantity=parseInt($(single).val());
                total=parseInt(price)*parseInt(quantity);
                $('#total'+id).val(net_price*1);
                calculate_grand_total();

var total_price=0;
var single_qty=0;
var total_amount=0;

 var product=$('#product'+id).find(':selected').val();


$( "#quantity"+count ).keyup(function() {



var required_quantity=parseInt($(this).val());

if(required_quantity==0){
 $('.sub').attr('disabled','true');
  $('.add_btn').attr('disabled','true');

        
         // $(required_quantity).css('border-color','#ff6666');
         $('.errors').html('<small id="id" class="help-block"  style="color:#ff6666;margin-left:250px;"> Quantity Field must not be Empty </small>')
         $(required_quantity).css('box-shadow','inset 0 1px 1px rgba(0, 0, 0, 0.075');


}

else{
    $(".help-block").css('display','none');
         // $(required_quantity).css('border-color','#ccc');

        $('.sub').removeAttr('disabled');
        $('.add_btn').removeAttr('disabled');


var single_qty=0;

   total_price=$('#price'+id).val();
  single_qty=parseInt($('#single_quantity'+id).val());   
        
  $.ajax({
type : 'POST',
        url : 'ajax_sum_quantity.php',
        dataType:"json",
        data  : {product_id:product},
        success : function (data){
      var total_quantity=0;
      total_quantity=$('#qnt'+id).val(data.total_quantity);
     
     
  parseInt($('#total'+id).val(total_price*required_quantity));
     

var net_qty=$(total_quantity).val();

    if(net_qty<required_quantity){

calculate_grand_total();

        $('.sub').attr('disabled','true');
         $('.add_btn').attr('disabled','true');

         // $(required_quantity).css('border-color','#ff6666');
         $('.errors').html('<small id="id" class="help-block"  style="color:#ff6666;margin-left:250px;">The required Quantity must not be grater than the &nbsp;&nbsp;'+net_qty + '&nbsp;&nbsp;which is quantity in the stock</small>')
         $(required_quantity).css('box-shadow','inset 0 1px 1px rgba(0, 0, 0, 0.075');

    }

   else{
                $('#total'+id).val(total_price*required_quantity);
          calculate_grand_total();

        $(".errors").html('');
         // $(required_quantity).css('border-color','#ccc');

        $('.sub').removeAttr('disabled');
        $('.add_btn').removeAttr('disabled');


   }       

     }
 });  
calculate_grand_total();

}

});
}
});

}

 function remove_item(id)
        {
            var div = '#row'+id;

            $(div).remove();

                calculate_grand_total();


        }


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




