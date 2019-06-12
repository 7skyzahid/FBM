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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Create New Warehouse Transfer</i></b></h2><br>
</div>
<div class="row">
<div class="col-md-12">
    <div class="panel " style="margin-left:3%">
        <div class="panel-heading">
            <h3 class="panel-title">
              <i class="fa fa-fw ti-pencil"></i> New Warehouse Transfer 
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
    <div class="col-md-3">
      <label><strong>Choose Date</strong></label>
      <input type="date"  class="form-control" name="date">
    </div>
    <div class="col-md-4" >
      <label><strong>Select Warehouse</strong></label> 
      <select   name="warehouse" class="form-contro0l select2" style="width:100%">
        <option value="0">--Choose--</option>
         <?php
           $select_w = "SELECT * FROM warehouses";
           $run_w = mysqli_query($connection,$select_w);
           while($row = mysqli_fetch_array($run_w))
           {
            $id = $row['id'];
            $name1 = $row['warehouse_name'];
            echo "<option value='$id'>  $name1  </option>";
           }
          ?>    
      </select>
    </div>
  </div>
<br><br>




<div class="row" id="new_row">
  <div class="col-md-1"></div>

  <div class="col-md-11" >
    <input type="hidden" name="row[]" value="1" id="total_fields">
    <div class="col-md-2">
      <label for="last_Name">Finished Product:</label>
      <select    name="finished_products[]" class="form-contro0l select2" style="width:100%">
       <option value="0">--Choose--</option>
       <?php
         $select_f = "SELECT * FROM finished_products";
         $run_f = mysqli_query($connection,$select_f);
         while($row = mysqli_fetch_array($run_f))
         {
          $id = $row['id'];
          $name2 = $row['product_name'];
          echo "<option value='$id'>  $name2  </option>";
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

    <div class="col-md-2">
      <label for="last_Name">Price:</label>
      <input type="text" name="price[]"  class="form-control" >
    </div>

    <div class="col-md-2">
      <label for="last_Name">Qunatity:</label>
      <input type="number" name="qunatity[]"  class="form-control">
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
  $date = $_POST['date'];
  $warehouse_id = $_POST['warehouse'];
  $date = date('Y-m-d');
  $count=count($_POST['row']);
  $insert_wt = "INSERT INTO warehouse_transfers(warehouse_transfer_date,warehouse_id,created_at) VALUES ('$date','$warehouse_id','$date')";
    $run_wt = mysqli_query($connection,$insert_wt);
    $last_id_wt = mysqli_insert_id($connection);

  for ($i=0;$i<$count;$i++) 
  {
   $finished_products=$_POST['finished_products'][$i];
   $packings=$_POST['packings'][$i];
   $price=$_POST['price'][$i];
   $qunatity=$_POST['qunatity'][$i];
   //echo $finished_products.' '.$packings.' '.$price.' '.$qunatity.'<br>';


    $insert_wtd  = "INSERT INTO warehouse_transfer_details(warehouse_transfer_id,finished_product_id,packing_id,price,quantity,created_at) VALUES
     ('$last_id_wt','$finished_products','$packings','$price','$qunatity','$date') ";
    $run_wtd = mysqli_query($connection,$insert_wtd);
    
  }
  if($run_wt && $run_wtd )
  {
    echo '<script> window.location.href = "add_wh_transfer.php";</script>';
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
      url:'add_row_wh.php',
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
