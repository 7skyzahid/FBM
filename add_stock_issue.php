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
<h2  class="font-weight-bold mb-1"><b> <i>Stock Issue To Saleman</i></b></h2> <a href="stock_issue.php" class="btn btn-primary" >View Stock Issue</a><br>
</div>
<div class="row">
<div class="col-md-12">
    <div class="panel " style="margin-left:3%">
        <div class="panel-heading">
            <h3 class="panel-title">
              <i class="fa fa-fw ti-pencil"></i> New Entry
            </h3>
            <span class="pull-right hidden-xs">
              <i class="fa fa-fw ti-angle-up clickable"></i>
              <i class="fa fa-fw ti-close removepanel clickable"></i>
            </span>
        </div>
<div class="panel-body">
<form method="post" action="" >
  <div class="row">
    <div class="col-md-2"></div>  
   
    <div class="col-md-3" >
      <label><strong>Select Saleman</strong></label> 
      <select   name="saleman" class="form-contro0l select2" style="width:100%">
        <option value="0">--Choose--</option>
         <?php
            $select1 = "SELECT * FROM sales_mens";
            $run1 = mysqli_query($connection,$select1);
            while($row= mysqli_fetch_array($run1))
            {
                
                $id1 = $row['id'];
                $sales_men_name = $row['sales_men_name'];
                echo "<option value='$id1'>$sales_men_name</option>";
            }
          ?>    
      </select>
    </div>

    <div class="col-md-3">
      <label><strong>Sell Policy</strong></label> 
      <select   name="policy" class="form-contro0l select2" style="width:100%">
        <option value="0">--Choose--</option>
        
         <?php
            $select1 = "SELECT * FROM sale_policies";
            $run1 = mysqli_query($connection,$select1);
            while($row= mysqli_fetch_array($run1))
            {
                
                $id1 = $row['id'];
                $name = $row['policy_name'];
                echo "<option value='$id1'>$name</option>";
            }
          ?>  
      </select>
    </div> 

  </div>
<br><br>




<div class="row" id="new_row">
  

  <div class="col-md-11" >
    <input type="hidden" name="row[]" value="1" id="total_fields">
    <div class="col-md-2">
      <label for="last_Name">Product:</label>
      <select    name="products[]" class="form-contro0l select2" style="width:100%">
       <option value="0">--Choose--</option>
       <?php
            $select1 = "SELECT * FROM product";
            $run1 = mysqli_query($connection,$select1);
            while($row= mysqli_fetch_array($run1))
            {
                
                $id1 = $row['id'];
                $title = $row['title'];
                echo "<option value='$id1'>$title</option>";
            }
          ?>
      </select>                                                  
    </div>
    <div class="col-md-2">
      <label for="last_Name">Packing:</label>
      <select    name="packings[]" class="form-contro0l select2" style="width:100%">
       <option value="0">--Choose--</option>
       <?php
         $select_p = "SELECT * FROM packings";
         $run_p = mysqli_query($connection,$select_p);
         while($row = mysqli_fetch_array($run_p))
         {
          $id = $row['id'];
          $name3 = $row['packing_name'];
          echo "<option value='$id'>  $name3  </option>";
         }
        ?> 
      </select>                                                  
    </div>

    <div class="col-md-1">
      <label for="last_Name">Pack:</label>
      <input id="pack" type="text" name="pack[]"  class="form-control" >
    </div>

    <div class="col-md-2">
      <label for="last_Name">Qunatity (P):</label>
      <input id="qunatity" type="number" name="qunatity[]"  class="form-control">
    </div>
    <div class="col-md-1">
      <label for="last_Name">Price:</label>
      <input id="price" type="number" name="price[]"  class="form-control">
    </div>
    <div class="col-md-1">
      <label for="last_Name">Bonus:</label>
      <input id="bonus" type="number" name="bonus[]"  class="form-control">
    </div> 
    <div class="col-md-1">
      <label for="last_Name">Total:</label>
      <input id="total" type="number" name="total[]"  class="form-control">
    </div>                 
    <div class="col-md-2">
      <button type="button" onclick="add_row()"  class="btn btn_3d button-royal pull-right btn-icon  btn-round m-r-50 a">
      <i class="icon fa fa-fw ti-plus" aria-hidden="true"></i></button>
    </div>
  </div>
</div>



<br>

  <div class="form-group form-actions">
    <div class="col-md-6 col-md-offset-5">
      <br>
      <button type="submit"  name="submit" class="button button-3d button-royal btn_3d sub">Create</button> 
    </div>
  </div>


</form>
<?php
if(isset($_POST['submit']))
{
  
  
  $count=count($_POST['row']);
  $saleman = $_POST['saleman'];
  $policy = $_POST['policy'];
  $date = date('Y-m-d');

  for ($i=0;$i<$count;$i++) 
  {
    
    $product = $_POST['products'][$i];
    $packings = $_POST['packings'][$i];
    $pack = $_POST['pack'][$i];
    $qunatity = $_POST['qunatity'][$i];
    $price = $_POST['price'][$i];
    $bonus = $_POST['bonus'][$i];
    $total = $_POST['total'][$i];
    

    //echo $product.$packings.$pack.$qunatity.$price.$bonus.$total.$date;

    $insert_wt = "INSERT INTO stock_issue(saleman_id,product_id,packing_id,policy_id,pack,qty,price,bonus,total,date) VALUES ('$saleman','$product','$packings','$policy','$pack','$qunatity','$price','$bonus','$total','$date')";
    $run_wt = mysqli_query($connection,$insert_wt);
   
  }
  if($run_wt  )
  {
    echo '<script> window.location.href = "add_stock_issue.php";</script>';
  }

}
?>          
</div>
</div>
</div>
</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
  var count=0;
  count=$('#total_fields').val();
  function add_row()
  {
    count++;
    $.ajax({
      url:'add_row_stock.php',
      type:'get',
      data:{'count':count},
      success(data1)
      {
        $('#new_row').append(data1);
        //console.log(data1);
      }

    });
  }

  function remove_item(id)
  {
    var div = '#row'+id;
    $(div).remove();
    // calculate_grand_total();
  }


$("#price").keyup(function(){
//var pack = $('#pack').val();
var qunatity = $('#qunatity').val();
var price = $('#price').val();
var total = $('#bonus').val();

var t1 = price * qunatity ; 

$('#total').val(t1);

});


$("#bonus").keyup(function(){
//var pack = $('#pack').val();
var qunatity = $('#qunatity').val();
var price = $('#price').val();
var total = $('#bonus').val();

var t1 = price - qunatity ; 

$('#total').val(t1);

});

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
