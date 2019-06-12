<?php
include 'includes/db.php';
$serial = 0;
?>
<!DOCTYPE html>
<html>
<head>
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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>SALES REPORT (MONTHLY) </i></b></h2><br>
</div>

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
               <div class="row">


                 <div class="col-md-2">
                    <img id="div1" src="img/logo.jpg" width="200px" height="160px" alt="clear"/>
                  </div>

                  <div class="col-md-1"></div>
                  <div id="div2" class="col-md-4 " style=" text-align: center;margin-top: 45px" >
                    <h4>Dr. Asma Arif <br> (Gynecologist, Obstetrician)</h4>
                    <h6>Noushera, Main GT Road, NLC Camp, Peshawar, Khyber Pakhtunkhwa</h6>
                  </div>

                  <div class="col-md-2"></div>

                  <div id="div3"  class="col-md-3 " style="margin-top: 45px">
                    <h5><strong>Monthly Sales Report <br>( Report Date: )</strong></h5>
                    <h4><strong> 
                      <?php
                      $date =  date('d-M-Y');
                      echo $date; 
                      ?>
                    </strong></h4>
                    <br>
                  </div>
              </div>
        <div class="row">



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



                               // $month = " SELECT s.quantity, date_format(s.created_at, '%Y-%m-%e') AS created_at, p.title, SUM(p.sale_price * s.quantity ) AS total_seling_price FROM sale_details s
                               //  LEFT JOIN stock_items p ON s.stock_item_id = p.id
                               //  WHERE date_format(s.created_at, '%Y') = '{$year}'
                               //  group by date_format(s.created_at,'%c'), s.stock_item_id
                               //  order by date_format(s.created_at,'%c') DESC ";
                               $grand = 0;
                                  
  

                                  $select_date = "SELECT sale_details.stock_single_price, sale_details.quantity, sale_details.created_date, product.title, stock_items.pur_price,stock_items.sale_price FROM sale_details JOIN stock_items JOIN product WHERE sale_details.stock_item_id = stock_items.id AND stock_items.product_id = product.id";
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
                             

                              

                               <tr >
                                 <td colspan="5"></td>
                                 <td colspan="2"><p style="font-weight: bold">Grand Total:                                  <?php echo $grand ?></p></td>
                                 

                               
                               </tr>
                               
                              
                          </table>
                        </div>
                    </div>
                </div>



        

                  <div class="col-md-12">
                      <h4><Strong>Terms and conditions:</Strong></h4>
                      <ul class="terms_conditions">
                          <!-- <li>An invoice must accompany products returned for warantty</li>
                          <li>Balance due within 10 days of invoice date,1.5% interest/month thereafter.</li> -->
                          <li>All goods returned for replacement/credit must be saleable condition with original
                              packaging.
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="btn-section">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                          <span class="pull-right">            
                          <button onclick="javascript:printDiv('printablediv')" type="button" class="btn btn-responsive button-alignment btn-primary"
                                   data-toggle="button">
                          <span style="color:#fff;" >
                                  <i class="fa fa-fw ti-printer"></i>
                              Print
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
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="js/app.js" type="text/javascript"></script>
<!-- end of page level js -->
<script src="js/app.js" type="text/javascript"></script>
<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script>
</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
