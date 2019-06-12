<?php
include 'includes/db.php';
$serial = 0;
?>
<!DOCTYPE html>
<html>
<head>
  
<?php

 include 'includes/head.php' ?>

</head>
<style type="text/css">
@media print {

  #mainDD
  {
    width: 100%;
    display: flex;


  }
  #div1
  {
    width: 400px;
    
  }

 @page {

  margin-bottom: 0;
  }

  #div2
  {
    width: 400px;
    
    

  }
  #div3
  {
    width: 400px;
    

  }
  
  .btn-section
  {
    display: none;
  }
  .dataTables_length
  {
    display: none;
  }
  #sample_1_filter
  {
    display: none;
  }
  #sample_1_info
  {
    display: none;
  }
  #sample_1_paginate
  {
    display: none;
  }
}
</style>

<script language="javascript" type="text/javascript">
function printDiv(divID) {
  var divElements = document.getElementById(divID).innerHTML;
  var oldPage = document.body.innerHTML;
  document.body.innerHTML = 
    "<html><head><title></title></head><body><table> " + 
    divElements + "</table> </body>";
  window.print();
  document.body.innerHTML = oldPage;
}
</script>

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
    <section class="content p-l-r-15" id="invoice-stmt">
<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>SALES REPORT BY DATE</i></b></h2><br>
</div>


<div>

     <div class="panel" style="margin-left:3%">
          <div class="panel-heading">
              <h3 class="panel-title">
                  <i class="fa fa-fw ti-credit-card"></i> Invoice
              </h3>
              <span class="pull-right">
                  <i class="fa fa-fw ti-angle-up clickable"></i>
                  <i class="fa fa-fw ti-close removepanel clickable"></i>
              </span>
          </div>
          <div id="printablediv"  class="panel-body">
              <div id="mainDiv"  class="row">

                <?php
                if(isset($_POST['submit1']))
                {
                  $date1 = $_POST['date1'];
                  $date2 = $_POST['date2'];
                  $newDate1 = date("Y-m-d", strtotime($date1));
                  $newDate2 = date("Y-m-d", strtotime($date2));
                ?>


                 <div class="col-md-2">
                    <img id="div1" src="img/ZARAK-logo.png" width="200px" height="160px" alt="clear"/>
                  </div>

                  <div class="col-md-1"></div>
                  <div id="div2" class="col-md-4 " style=" text-align: center;margin-top: 45px" >
                    <h4>Dr. Asma Arif <br> (Gynecologist, Obstetrician)</h4>
                    <h6>Noushera, Main GT Road, NLC Camp, Peshawar, Khyber Pakhtunkhwa</h6>
                  </div>

                  <div class="col-md-2"></div>

                  <div id="div3"  class="col-md-3 " style="margin-top: 45px">
                    <h5><strong>Supplier Report <br>( Report Date: )</strong></h5>
                    <h4><strong> 
                      <?php
                      $date =  date('d-M-Y');
                      echo $date; 
                      ?>
                    </strong></h4>
                    <br>
                  </div>



                  

                </div>

                  <div  class="col-md-12">
                    <div class="panel ">
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="sample_1">
                              <thead>
                                <tr>
                                <th>
                                      <strong>#</strong>
                                  </th>
                                  <th>
                                      <strong>Date</strong>
                                  </th>
                              

                                  <th >
                                      <strong>
                                        Product 
                                      </strong>
                                  </th>
                                  <th >
                                      <strong>
                                        Purchasing Price
                                      </strong>
                                  </th>
                                  <th >
                                      <strong>
                                        Sale Price
                                      </strong>
                                  </th>
                                  
                                  <th >
                                      <strong>
                                        Quantity
                                      </strong>
                                  </th>
                                  <th >
                                      <strong>
                                        Total
                                      </strong>
                                  </th>                                  
                                </tr>
                              </thead>
                              
                              <tbody>
                                <?php
                                  
                                    // $select_date = " SELECT s.id ,s.created_at,p.title, p.pur_price,p.sale_price,
                                    //  COUNT(s.stock_item_id) AS total_records,

                                    //  SUM(s.quantity) AS total_sales,
                                    //  SUM(p.sale_price * s.quantity) AS total_selling_price,

                                    //  SUM(p.pur_price*s.quantity) AS  total_buying_price
                                    //  FROM sale_details s
                                    //  LEFT JOIN stock_items p ON s.stock_item_id = p.id WHERE
                                    //  s.created_at BETWEEN '$newDate1' AND '$newDate2' GROUP BY DATE(s.created_at),p.title ORDER BY DATE(s.created_at) ASC;";

                                // SUM(stock_items.sale_price * sale_details.quantity) as grand 

                                $grand =0 ; 

                                  $select_date = "SELECT sale_details.stock_single_price, sale_details.quantity, sale_details.created_date, product.title, stock_items.pur_price,stock_items.sale_price FROM sale_details JOIN stock_items JOIN product WHERE sale_details.stock_item_id = stock_items.id AND stock_items.product_id = product.id AND sale_details.created_date BETWEEN '$date1' AND '$date2' ORDER BY sale_details.created_date ASC  ";
                                  $run_select = mysqli_query($connection,$select_date);
                                  while($row=mysqli_fetch_array($run_select))
                                  {
                                    $title = $row['title'];
                                    $sale_price = $row['sale_price'];
                                    $pur_price = $row['pur_price'];
                                    $quantity = $row['quantity'];
                                    $date = $row['created_date'];
                                    $newDate = date("d-m-Y", strtotime($date));
                                    $total = $sale_price * $quantity;
                                    $grand = $grand + $total;
                                    $serial = $serial + 1; 
                                ?>
                                <tr>
                                  <td><?php echo $serial ; ?></td>
                                  <td><?php echo $newDate ; ?></td>
                                  <td><?php echo $title ; ?></td>
                                  <td><?php echo $pur_price ; ?></td>
                                  <td><?php echo $sale_price ; ?></td>
                                  <td><?php echo $quantity ; ?></td>
                                  <td><?php echo $total ; ?></td>
                                </tr>

                              <?php } ?>
                              </tbody>
                              
                              
                              


                               <tr>
                                 <td colspan="5"></td>
                                 <td colspan="2"><p style="font-weight: bold">Grand Total: <?php echo $grand; ?>  </p></td>
                               </tr>
                               
                              
                          </table>
                        </div>
                    </div>
                </div>

<?php } ?>                  
                  <div class="col-md-12">
                      <h4><Strong>Terms and conditions:</Strong></h4>
                      <ul class="terms_conditions">
                        <li>All goods returned for replacement/credit must be saleable condition with original packaging.
                        </li>
                      </ul>
                  </div>
              </div>

              <div class="btn-section">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <span class="pull-right">            
                      <button style="display: block" id="button1" onclick="javascript:printDiv('printablediv')" type="button" class="btn btn-responsive button-alignment btn-primary"
                               data-toggle="button">
                      <span style="color:#fff;" >
                        <i class="fa fa-fw ti-printer"></i> Print  
                      </span>
                      </button>
                    </span>
                  </div>
              </div>
          </div>
      </div>
</div>      
<?php include 'includes/right-menu.php' ?>
</div>
<script src="js/app.js" type="text/javascript"></script>
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>
</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 8) {
window.location.href = "sales_report.php";
}
};
</script>
