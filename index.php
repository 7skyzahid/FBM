<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php 
  session_start(); 

include 'includes/head.php'; ?>
</head>

<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php'; ?>

<aside class="right-side">

<!-- Main content -->
<section class="content">
<br>



<div class="row">
    
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-eye text-warning"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b>
                        <?php
                        $product = "SELECT * FROM materials";
                        $run_pro = mysqli_query($connection,$product);
                        $pro_total =  mysqli_num_rows($run_pro);
                        echo $pro_total;
                        ?>
                    </b></h3>
                    <p><a href="all_products.php">Total Materials</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-eye text-danger"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b>
                        <?php
                        
                         
                        $items = "SELECT * FROM materials";
                        $run_items = mysqli_query($connection,$items);
                        $items_total =  mysqli_num_rows($run_items);
                        echo $items_total;
                        ?>
                    </b></h3>
                    <p><a href="all_stock_products.php">Stock Items</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
           
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-shopping-cart text-success"></i>
                </div>
                <div class="text-right">
                    <h3><b id="widget_count3">
                        <?php
                        $date = date('Y-m-d');
                         
                        $sales = "SELECT sum(grand_total_amount) AS total FROM `stock_sales` where created_date = '$date'";
                        $run_sales = mysqli_query($connection,$sales);
                        while($row=mysqli_fetch_array($run_sales))
                        {
                            $total = $row['total'];
                            echo $total;
                        }
                        
                        ?>
                    </b></h3>
                    <p><a href="daily_sales.php">Daily Sales Amount</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
           
        </div>
    </div>

     
    <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="flip">
            <div class="widget-bg-color-icon card-box front">
                <div class="bg-icon pull-left">
                    <i class="ti-user text-info"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b>
                         <?php
                        $date = date('Y-m-d');
                         
                        $due = "SELECT sum(due_amount) AS total FROM `stock_sales` where created_date = '$date'";
                        $run_sale = mysqli_query($connection,$due);
                        while($row=mysqli_fetch_array($run_sale))
                        {
                            $total = $row['total'];
                            echo $total;
                        }
                        
                        ?>
                    </b></h3>
                    <p><a href="dues_report_sales.php">Today Due Amount</a></p>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            
        </div>
    </div>
</div>


<div class="row">
    
    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Zero Qunatity Stock Items</span>
           </strong>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="sample_1">
            <thead>
              <tr>
                  <th><strong>#</strong></th><th><strong> Product</strong></th>
                  <th ><strong>Quantity</strong></th>
                  <th><strong>Purchase Price</strong></th>
                  
                  <th ><strong>Supplier </strong></th><th ><strong> Expiry Date</strong>
              
              </tr>
            </thead>
            <tbody id="display">
                <?php
                // $value=0;
                //   $serial = 0;
                //     $prodque =  "SELECT * FROM  materials ";
                //     $prodfun = mysqli_query($connection,$prodque);
                //     while($proddata=mysqli_fetch_array($prodfun))
                //     {
                //         $prodid = $proddata['id'];
                //         $prodname = $proddata['title'];
                //         $minqnty = $proddata['min_quantity'];


                //         $fetch =  "SELECT * FROM  stock_items WHERE quantity<='0' AND product_id='$prodid'  ";
                //         $run_name = mysqli_query($connection,$fetch);
                //         while($row=mysqli_fetch_array($run_name))
                //         {
                //            // SUM(total_cost)
                //            $sid = $row['id'];

                //            $supp = $row['supplier_id'];
                //            $total = $row['total_price'];
                //            $prodqnty = $row['quantity'];
                //           $xpiry = $row['expiry_date'];
                //           $purprice = $row['pur_price'];
                //           $saleprice = $row['sale_price'];

                //         $fetch2 =  "SELECT * FROM  suppliers WHERE id='$supp' ";
                //         $run_name2 = mysqli_query($connection,$fetch2);
                //         while($row2=mysqli_fetch_array($run_name2))
                //             {
                //                 $supplier=$row2['name'];



                //       $serial++;
                     ?>
                    <tr>
                    <!--     <td><?php echo $serial; ?></td>
                        <td><?php echo $prodname; ?></td>
                        <td><?php echo $prodqnty; ?></td>
                        
                        <td><?php echo $purprice; ?></td>
                        
                        <td><?php echo $supplier; ?></td>
                        <td><?php echo $xpiry; ?></td> 
                        -->
                    </tr>
                        <?php 
                    // } }  }  
                    ?> 
                    </tbody>
                </table>
            </div>
        </div>

            
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Keyboard Shortcut Keys</span>
           </strong>
          </div>
            <div class="panel-body">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name *</th>
                        <th>Keys *</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Submit Form</td>
                        <td>Enter Key  </td>
                    </tr>
                    <tr>
                        <td>Update Form</td>
                        <td>Enter Key  </td>
                    </tr>
                    <tr>
                        <td>Invoice Print</td>
                        <td>Enter Key</td>
                    </tr>
                    <tr>
                        <td>Go Back</td>
                        <td>Escape Key </td>
                    </tr>
                    
                   
                  
                </tbody>
              </table>
           </div>
        </div>
    </div>
</div>



<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>

<script src="js/app.js" type="text/javascript"></script>


</body>
</html>
