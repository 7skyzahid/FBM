<?php include 'includes/db.php'; ?>

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
      <div class="box-header with-border">
        <h2 style="margin-left: 20%" class="font-weight-bold mb-1"><b> <i>UPDATE RETURN SALES </i></b></h2><br>
      </div>
      <br>

      <form action="" method="POST">

        <?php
          if (isset($_GET['gid'])) 
          {
             $Gid=$_GET['gid'];
             $grand = 0;

             $query1 = "SELECT * FROM sale_details WHERE stock_sale_id = '$Gid' ";
             $run1 = mysqli_query($connection,$query1);
                $i=0;

             while($row = mysqli_fetch_array($run1))
               {
                $total =  $row["stock_single_price"]*$row["quantity"];
                $grand = $grand + $total;  

                ?>



                <?php

                
                $stock_item_id = $row['stock_item_id'];
                  
               $query = "SELECT * FROM stock_items WHERE id = '$stock_item_id' ";
            
               $get_stocks_items=mysqli_query($connection,$query);
               while($stock_items=mysqli_fetch_array($get_stocks_items)){
              
               $pro_id=$stock_items['product_id'];

               $sql = "SELECT * FROM product WHERE id = '$pro_id' ";
               $get_products=mysqli_query($connection,$sql);
                while($products=mysqli_fetch_array($get_products)){
                 $i++;

                  ?>                      
                <div class='row'>

                <div class='col-md-1'></div>
                <div class='col-md-2'>
                  <div class='form-group'>
                    <label><b>Product</b><span class='text-danger'>*</span></label>
                    <input id='' type='text'  class='form-control input-sm' name='product[]'  value='<?php echo $products["title"]?>'>
                  </div>
                </div>
                
                <div class='col-md-2'>
                  <div class='form-group'>
                    <label><b>Price</b><span class='text-danger'>*</span></label>
                    <input id='purchase<?php echo $i;?>' type='text'  class='form-control input-sm prc' name='price[]'  value='<?php echo $row["stock_single_price"] ;?>' >
                  </div>
                </div>
                <input type="hidden" name="sale_detail_id[]" value="<?php echo  $row['id']; ?>">

                <div class='col-md-1'>
                  <div class='form-group'>
                    <label><b>Qunatity</b><span class='text-danger'>*</span></label>
                    <input onkeyup="changeQuantity(<?php echo $i;?>)" id='quantity<?php echo $i;?>'    type='text'   class='form-control input-sm qqty' name='quantity[]'  value='<?php echo $row["quantity"];?> ' >
                  </div>
                </div>

                <div class='col-md-2'>
                  <div class='form-group'>
                    <label><b>Total</b><span class='text-danger'>*</span></label>
                    <input  id='total<?php echo $i;?>' type='text'  class='form-control input-sm'  value='<?php echo $total  ?>' >
                  </div>
                </div>

                <div class='col-md-2'>
                  <div class='form-group'>
                    <label><b>Date</b><span class='text-danger'>*</span></label>
                    <input id='' type='text'  class='form-control input-sm' name='date[]'  value='<?php echo  $row["created_date"]; ?>' >
                  </div>
                </div>

               </div>
               <?php  }
             }

            } 
            
          }
          ?>

      <br>

      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-2">
          <div class="form-group">
            <label><b>Grand Total Amount</b><span class="text-danger">*</span></label>
            <input id="grand_total_amount" type="text"  class="form-control input-sm" name="grand"  value="<?php echo $grand ?>" >
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label><b>Paid</b><span class="text-danger">*</span></label>
            <input id="paid" type="text"  class="form-control input-sm" name="paid"  value="" >
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <label><b>Due</b><span class="text-danger">*</span></label>
            <input id="due" type="text"  class="form-control input-sm" name="due"  value="" >
          </div>
        </div>
      </div>

      <br><br>

      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-1">
          <input type="submit" name="save" id="save" value="Update" class="btn btn-primary">
        </div>
        <div class="col-md-1">
          <a href="return_sale.php" class="btn btn-danger" >Cancel</a>
        </div>
      </div>


    </div>

</form>




</div>
</section>
</aside>





<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>
<script type="text/javascript">

function changeQuantity(id)
{
  var quantity=$('#quantity'+id).val();
  var price=$('#purchase'+id).val();
  $('#total'+id).val(price*quantity);

  
}


$("#paid").keyup(function(){
  var total= $('#grand_total_amount').val();
  var paid=$('#paid').val();
   var due = total - paid;
   $('#due').val(due);
});

  // $(document).ready(function(){
  // });
</script>

<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "return_sale.php";
}
};
</script>
</body>
</html>
<?php

if(isset($_POST['save']))
{
  $grand = $_POST['grand'];
  $paid = $_POST['paid'];
  $due = $_POST['due'];
  $query = "UPDATE `stock_sales` SET `grand_total_amount`= '$grand',`paid_amount`='$paid',`due_amount`='$due'  WHERE id = '$Gid' ";
  $run = mysqli_query($connection,$query);
  

$count=count($_POST['product']);

for($i=0;$i<$count;$i++){
$id=$_POST['sale_detail_id'][$i];
$product=$_POST['product'][$i];
$price=$_POST['price'][$i];
echo $price;

$quantity=$_POST['quantity'][$i];
$date=$_POST['date'][$i];


$sql="UPDATE `sale_details` SET `stock_single_price`='$price',`quantity`='$quantity',`created_date`='$date' WHERE id='$id' ";

$update_query=mysqli_query($connection,$sql);

if($update_query){


}


}


}
?>

