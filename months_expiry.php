<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
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
<?php include 'includes/head.php' ?>
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
</head>
<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>
<aside class="right-side">
<section class="content">
  <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>Expiry Report By Date</i></b></h2><br>
</div>
<div class="row">
  <div class="col-md-2"></div>

  <div class="col-md-3">
    <input type="date" name="start_date" id="date1" class="form-control " autocomplete="off" placeholder="Type Name" />  
  </div>

  <div class="col-md-1"  style='font-size: 14px;padding-top: 5px;font-weight: bold '>TO</div>
  <div class="col-md-3">
    <input type="date" class="form-control" id="date2" name="end_date" va>
  </div>
  
</div>

<div class="panel" >
  <div class="panel-heading">
      <h3 class="panel-title">
          <i class="fa fa-fw ti-credit-card"></i> Report
      </h3>
      <span class="pull-right">
          <i class="fa fa-fw ti-angle-up clickable"></i>
          <i class="fa fa-fw ti-close removepanel clickable"></i>
      </span>
  </div>
  <div id="printablediv"  class="panel-body">
      <div id="mainDiv"  class="row">
        <div id="mainDD" >
          <div class="col-md-2">
            <img id="div1" src="img/ZARAK-logo.png" width="200px" height="160px" alt="clear"/>
          </div>
          <div class="col-md-1"></div>
          <div id="div2" class="col-md-4 " style=" text-align: center;margin-top: 45px" >
            <h4>Dr. Asma Arif <br> (Gynecologist, Obstetrician)</h4>
            <h6>Noushera, Main GT Road, NLC Camp, Peshawar, Khyber Pakhtunkhwa</h6>
           <!--  <h4>Supplier Name:   <span id="shows">  </span> </h>  -->
          </div>
          <div class="col-md-2"></div>
          <div id="div3"  class="col-md-3 " style="margin-top: 45px">
            <h5><strong>Expiry Report <br>( Report Date: )</strong></h5>
            <h5>
              <?php
              $date =  date('d-M-Y');
              echo $date; 
              ?>
            </h5>
            <br>
          </div>
        </div>
       <br>
        <div class="col-lg-12">
            <div class="panel ">
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Expiry Date</th>
                        <th id="supply">Supplier Name</th>
                        <th>Batch No: </th>                                
                        <th>Product: </th>
                        <th>Purchase Price</th>
                        <th>Qunatity</th>
                        
                        <th>Total</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody id="display">
                      <?php
                      $serial = 0;
                     
                      

                      // $select = "SELECT stock_items.product_id ,stock_items.expiry_date,  stock_items.quantity, stock_items.pur_price, stock_items.total_price,stock_items.batch,stock_items.supplier_id, stock_items.date FROM stock_items WHERE DATE(stock_items.expiry_date) BETWEEN DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) AND LAST_DAY(DATE_SUB(NOW(), INTERVAL 1 MONTH))";
                      $select = "SELECT   stock_items.product_id ,stock_items.expiry_date,  stock_items.quantity, stock_items.pur_price, stock_items.total_price,stock_items.batch,stock_items.supplier_id, stock_items.date FROM stock_items WHERE Month(stock_items.expiry_date) = month(CURRENT_DATE())";

                      $run = mysqli_query($connection,$select);

                      while($row = mysqli_fetch_array($run))
                      {
                        $serial++;
                        $product_id = $row['product_id'];
                        $expiry = $row['expiry_date'];
                        $exDate = date("d-m-Y", strtotime($expiry));

                        $quantity = $row['quantity'];
                        $pur_price = $row['pur_price'];
                        $total_price = $row['total_price'];
                        $batch_no = $row['batch'];
                        $supplier_id = $row['supplier_id'];
                        $date = $row['date'];
                        $newDate = date("d-m-Y", strtotime($date));
                       
                      ?>
                      <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $exDate ?></td>
                        <td>
                          <?php
                          $sup = "SELECT * FROM suppliers WHERE id = '$supplier_id'";
                          $run_sup = mysqli_query($connection,$sup);
                          while($row = mysqli_fetch_array($run_sup))
                          {
                            echo $row['name'];
                          }
                          ?>
                        </td>
                        <td><?php echo $batch_no ?></td>
                        <td>
                          <?php
                          $pro = "SELECT * FROM product WHERE id = '$product_id'";
                          $run_pro = mysqli_query($connection,$pro);
                          while($row = mysqli_fetch_array($run_pro))
                          {
                            echo $row['title'];
                          }
                          ?>
                        </td>
                        <td><?php echo $pur_price ?></td>
                        <td><?php echo $quantity ?></td>
                        
                        <td><?php echo $total_price ?></td>
                        <td><?php echo $newDate ?></td>
                        
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
        </div>

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
<?php include 'includes/right-menu.php' ?>
    <!-- /.right-side -->
</div>
<script src="js/app.js" type="text/javascript"></script>
<script src="vendors/select2/js/select2.js" type="text/javascript"></script>
<script src="js/autosearch/bootstrap3-typeahead.min.js"></script> 
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>
 <script>
$(document).ready(function(){
  $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


$(document).ready(function(){
  $('#date1').change(function()
{
  $('#date2').change(function()
  {
    var start_date = $('#date1').val();
    var end_date = $('#date2').val();
   
  
    
      $.ajax({
        type : 'POST',
        url : 'months_expiry_process.php',
        data  : {start_date:start_date,end_date:end_date},
        success : function (data)
        {
          var some_data=$("#display").html(data);         
        }
      });
    

  });

});
});
</script> 
</body>
</html>
