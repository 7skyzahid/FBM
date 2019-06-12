<?php
include 'includes/db.php';
$serial = 0;

$mydate=date('Y-m-d');
?>
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


<link rel="stylesheet" type="text/css" href="css/print.css" media="print" />
<?php include 'includes/head.php' ?>

</head>

<body class="skin-default">
<!-- <div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div> -->
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>

<aside class="right-side">  
  <!-- Main content -->
<section class="content">
  <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>PROFIT & LOSS</i></b></h2><br>
</div>

  
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-3">
      <input type="date" name="start_date" id="date1" class="form-control " value="<?php echo $mydate;?>" />  
    </div>
    <div class="col-md-1"  style='font-size: 14px;padding-top: 5px;font-weight: bold '>TO</div>
    <div class="col-md-3">
      <input type="date" class="form-control" id="date2" name="end_date" value="<?php echo $mydate;?>">
    </div>
    
  </div>

<br>


<div class="panel" style="margin-left: 3%" >
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
            <img id="div1" src="img/small-logo.jpg" width="200px" height="160px" alt="clear"/>
          </div>

          <div class="col-md-1"></div>
          <div id="div2" class="col-md-4 " style=" text-align: center;margin-top: 45px" >
            <h4>Dr. Asma Arif <br> (Gynecologist, Obstetrician)</h4>
            <h6>Noushera, Main GT Road, NLC Camp, Peshawar, Khyber Pakhtunkhwa</h6>
          </div>

          <div class="col-md-2"></div>

          <div id="div3"  class="col-md-3 " style="margin-top: 45px">
            <h5><strong>Profit & Loss <br>( Report Date: )</strong></h5>
            <h4><strong> 
              <?php
              $date =  date('d-M-Y');
              echo $date; 
              ?>
            </strong></h4>
            <br>
          </div>
        </div>
      </div>

  

      <div class="row">


           <div class="col-lg-12">
              <div class="panel ">
                  
                  <div class="panel-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover" id="sample_1">
                              <thead>
                              <tr class="bg-primary">
                                <th>#</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                                
                              </tr>                             
                              </thead>
                              <tbody id="display" >
                                <?php
                                $serial = 0;
                                $total = 0;
                                $grand_debit = 0;
                                $grand_credit = 0;
                                $grand_total  = 0;
                                $profit = "SELECT profit.created_date AS dates , GROUP_CONCAT( DISTINCT profit.name ORDER BY profit.name ASC SEPARATOR '<br><br>' ) AS names ,GROUP_CONCAT(profit.description) AS descr , SUM(profit.debit) AS debits,SUM(profit.credit) AS credits FROM profit GROUP by profit.created_date order by profit.name ASC  ";

                                $run = mysqli_query($connection,$profit);
                                while($row = mysqli_fetch_array($run))
                                {
                                  $serial = $serial + 1;
                                  $name = $row['names'];
                                  $name_sup=explode(',', $name);
                                  $description = $row['descr'];
                                  $debit = $row['debits'];
                                  $credit = $row['credits'];
                                  $date = $row['dates'];
                                  $newDate2 = date("d-m-Y", strtotime($date));

                                  $total = $debit - $credit;
                                  $grand_debit = $grand_debit + $debit;
                                  $grand_credit = $grand_credit + $credit;
                                  $grand_total = $grand_total + $total;
                                      
                                

                                ?>
                                <tr>
                                  <td><?php echo $serial ; ?></td>
                                  <td><?php echo $newDate2 ; ?></td>
                                  <td>
                                    <?php 
                                    foreach($name_sup as $result)
                                    {
                                      
                                      echo " " .$result."<br>";
                                      
                                    }
                                   ?>
                                  </td>
                                
                                  <td>
                                  <?php
                                    if($debit == 0)
                                    {
                                      echo "";
                                    }else
                                    {
                                      echo $debit ;

                                    }

                                  ?>
                                    
                                  </td>

                                  <td>
                                  <?php 

                                    if($credit == 0)
                                    {
                                      echo "";
                                    }else
                                    {
                                      echo '<br><br>'.$credit ;

                                    }


                                  ?>
                                     
                                  </td>
                                  <td><br><br><?php echo $total; ?></td>
                                  
                                </tr>
                              <?php } ?>
                              </tbody>

                              <tfoot>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td style="font-weight: bold;">Grand Total</td>
                                  <td style="font-weight: bold;">Rs. <?php echo $grand_debit; ?> </td>
                                  <td style="font-weight: bold;">Rs. <?php echo $grand_credit; ?></td>
                                  <td style="font-weight: bold;">Rs. <?php echo $grand_total; ?></td>
                                </tr>
                              </tfoot>


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

<script src="js/app.js"></script>
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


$('#date1').change(function() // for date
{

  $('#date2').change(function() // 
  {
  

    var start_date = $('#date1').val();
    var end_date = $('#date2').val();
    
    
    $.ajax({
      type : 'POST',
      url : 'profit_process.php',
      data  : { 
                start_date:start_date,
                end_date:end_date
                },
      success : function (data)
      {
       

        $("#display").html(data);
      }
    });
  });

});



});


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
</body>
</html>
<script type="text/javascript">
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
