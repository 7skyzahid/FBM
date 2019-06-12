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



    <!-- Main content -->
    <section class="content">


        <div class="content-wrapper animatedParent animateOnce">
<div class="container" >
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>NEW SALE</i></b></h2><br>
</div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel " style="margin-left:3%">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="fa fa-fw ti-pencil"></i> New Sale 
                        </h3>
                        <span class="pull-right hidden-xs">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                    </div>


<div class="panel-body">
    <form method="post" action="add_sales.php" >
<div class="col-md-4" > 
<input type="text" name="customer"  placeholder="Patient Name / Patient Mobile NO" class="form-control ">
</div>
<div style="    margin-bottom: 25px;
"><br><br></div>
<div class="col-md-6  errors">
</div>


<div class="row" id="new_row">

<div class="col-md-12" id="row1">
    <input type="hidden" name="row[]" value="1" id="total_fields">
    <input type="hidden" name="stock_item_id[]" value="1" id="stock_item_id1">
    <input type="hidden" name="qnt[]" id="qnt1">
    <input type="hidden" name="single_quantity[]" class="single" id="single_quantity1">


    <div class="col-md-2">
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
    <input type="text" name="price[]" id="price1" class="form-control" readonly>
</div>

<div class="col-md-2">
    <label for="last_Name">Qunatity:</label>
    <input type="number" name="quantity[]" required   id="quantity1"  class="form-control qty">
</div>

      <div class="col-md-2">
    <label  for="last_Name">Total:</label>
    <input type="text" name="total[]" id="total1" class="form-control" readonly>
</div>
                     
<div class="col-md-2">
<button type="button" onclick="add_row()" class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50 add_btn">
<i class="icon fa fa-fw ti-plus" aria-hidden="true"></i></button>
</div>
    </div>
       
</div>                            
<br>

<div class="col-md-2">
<label for="last_Name">Grand Total:</label>
<input class="form-control col-md-2" type="number" id="grand_total_amount" name="grand_total_amount"  value="0"  readonly>
</div>

<div class="col-md-2">
<label>Discount:</label>
<input type="text" name="discount" id="discount" class="form-control">
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

<br><br>
 
                            <div class="form-group form-actions">
                                <div class="col-md-6 col-md-offset-5">
                                  <br>
                                    <button type="submit" id="submit_btn" name="submit" class="button button-3d button-royal btn_3d sub">Create</button>
                                   
                                </div>
                            </div>



                        </form>
                
                    </div>
                
                </div>
            </div>
        </div>









<script src="js/jquery.min.js"></script>
<script>
var count=0;
count=$('#total_fields').val();

    function add_row() {


        count++;

   $.ajax({
      url:'add_row.php',
      
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


//Ishti Script

$("#discount").keyup(function(){
var total= $('#grand_total_amount').val();
var disc=$('#discount').val();
// var aftdisc = total - disc;
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
                       
                $grand_total_amount=$_POST['grand_total_amount'];
                                $discount=$_POST['discount'];
                                $discounted_amount=$_POST['afdisc'];
                                $paid_amount=$_POST['paid'];
                                $due_amount=$_POST['due'];
                                $created_date=date('Y-m-d');
                                $customer=$_POST['customer'];
                                
                                
          $cus_profit = "Sales";
      $random = mt_rand(1,2000);

      $profit = "INSERT INTO profit(sale_id,name,debit,credit,created_date)
      values ('$random','$cus_profit','$due_amount','$paid_amount','$created_date') ";
      $run_profit = mysqli_query($connection,$profit);                
                                
                                

     if ($due_amount>0) {
                          
       $sql="INSERT INTO `stock_sales`(profit_id,`customer`, `grand_total_amount`, `discount`, `discounted_amount`, `paid_amount`, `due_amount`, `created_date`,`status`) VALUES 
                      ('$random','$customer','$grand_total_amount','$discount','$discounted_amount','$paid_amount','$due_amount','$created_date','1')";
      }
      else{

         $sql="INSERT INTO `stock_sales`( profit_id,`customer`, `grand_total_amount`, `discount`, `discounted_amount`, `paid_amount`, `due_amount`, `created_date`,`status`) VALUES 
                        ('$random','$customer','$grand_total_amount','$discount','$discounted_amount','$paid_amount','$due_amount','$created_date','0')";
        }

                            $insert_to_stock_sale=mysqli_query($connection,$sql);
                            $last_stock_sale_id=mysqli_insert_id($connection);
                             $count=count($_POST['row']);
                                
                                 $prd_id=$_POST['product_id'];
                            
                              for ($i=0;$i<$count;$i++) {
                                
                                $required_quantity=$_POST['quantity'][$i];
                                 // echo $required_quantity.'<br>';
                               $price=$_POST['price'][$i];
                               $required_quantity=$_POST['quantity'][$i];
                               $stock_quantity=$_POST['single_quantity'][$i];
                               $stock_item_id=$_POST['stock_item_id'][$i];
                               $created_date=date('Y-m-d');
                               $stock_product_id=$_POST['product_id'][$i];

                             if($required_quantity<=$stock_quantity){                              

                               $stock_item_sql="SELECT id,product_id,sale_price,quantity
                                                 FROM `stock_items` 
                                                 WHERE product_id='$stock_product_id' AND
                                                       quantity>0
                                                 ORDER BY expiry_date ASC LIMIT 1";
                               $get_stock_item=mysqli_query($connection,$stock_item_sql);





                               while($stock_item_row=mysqli_fetch_array($get_stock_item)){
                                       
                                       

                                  $in_stock_quantity=$stock_item_row['total_quantity'];
                                  
                                  $single_qunatity=$stock_item_row['quantity'];
                                   
                                   $net_qty=$stock_quantity-$required_quantity;
                                  
                                  $product_id_for_update=$stock_item_row['product_id'];
                                  $sale_price=$stock_item_row['sale_price'];
                                  $stock_id_for_update=$stock_item_row['id'];

                                    $product_id_for_update=$stock_item_row['product_id'];
                                    $stock_id_for_update=$stock_item_row['id'];
                                    $update_sql="UPDATE `stock_items` SET `quantity`='$net_qty' WHERE
                                              id='$stock_id_for_update' AND product_id='$product_id_for_update'    ";

                                      

                                    $update_stock_item=mysqli_query($connection,$update_sql);

                                    
                                     }

                              
                               $sql2="INSERT INTO `sale_details`( `stock_sale_id`, `stock_item_id`, `stock_single_price`, `quantity`, `created_date`) VALUES ('$last_stock_sale_id','$stock_item_id','$price','$required_quantity','$created_date')";
                               $insert_to_stock_sale_detail=mysqli_query($connection,$sql2);

                                     
                                     }




                                else{


                                  $stock_item_second_sql="SELECT id,product_id,sale_price,quantity
                                                 FROM `stock_items` 
                                                 WHERE product_id='$stock_product_id' AND
                                                       quantity>0 
                                                 ORDER BY expiry_date ASC ";
                                                 
                              

                               $get_stock_second_item=mysqli_query($connection,$stock_item_second_sql);
                                
                                while($obj=mysqli_fetch_array($get_stock_second_item) AND $required_quantity>0){
                                
                                     $stk_id=$obj['id'];         
                                     $qnnt=$obj['quantity'];
                                     $second_sale_price=$obj['sale_price'];

                                        $net=$required_quantity-$qnnt;

                                     if($qnnt<$required_quantity){

                                        $required_quantity=$required_quantity-$qnnt;


                                  $update_sql="UPDATE `stock_items` SET `quantity`=0 WHERE
                                               id='$stk_id'   ";
                                      
                               $sql3="INSERT INTO `sale_details`( `stock_sale_id`, `stock_item_id`, `stock_single_price`, `quantity`, `created_date`) VALUES ('$last_stock_sale_id','$stk_id','$second_sale_price','$qnnt','$created_date')";



                               $insert_to_stock_sale_detail=mysqli_query($connection,$sql3);
                                    
                                

                                      }

                                 else{
                                        $required_quantity=$qnnt-$required_quantity;


                                  $update_sql="UPDATE `stock_items` SET `quantity`='$required_quantity' WHERE
                                               id='$stk_id'   ";
                                      
                               $sql4="INSERT INTO `sale_details`( `stock_sale_id`, `stock_item_id`, `stock_single_price`, `quantity`, `created_date`) VALUES ('$last_stock_sale_id','$stk_id','$second_sale_price','$required_quantity','$created_date')";
                               $insert_to_stock_sale_detail=mysqli_query($connection,$sql4);
                                }
                                $update_stock_item=mysqli_query($connection,$update_sql);
                         }


                     }


                   }
                   
$query2="INSERT INTO `sales_due_history`
(`stock_sales_id`,`customer`,`grand`,`paid_total`,`due`, `created_date`)
 VALUES ('$last_stock_sale_id','$customer','$discounted_amount','$paid_amount','$due_amount','$created_date')";
    $result2 = mysqli_query($connection, $query2);

                   
                   
                   
                   


$sql_for_sale=("SELECT * FROM stock_sales ORDER BY id DESC LIMIT 1");
$que2=mysqli_query($connection,$sql_for_sale);
while ($row5=mysqli_fetch_array($que2)) {
$stk_sl_id=$row5['id'];
echo "<script>window.open('invoice.php?id=".$stk_sl_id."','_self')</script>";
}


               }
             ?>
