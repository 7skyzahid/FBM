<?php
include 'includes/db.php';
$serial = 0;
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
<script language="javascript" type="text/javascript">
function printDiv(divID) {
  var divElements = document.getElementById(divID).innerHTML;
  var oldPage = document.body.innerHTML;
  document.body.innerHTML = 
    "<html><head><title></title></head><body><table> " + 
    divElements + "</table> </body>";
  window.print();
  document.body.innerHTML = oldPage;
  window.location.reload();
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
    <!-- Content Header (Page header) -->

    <!-- Main content -->

<section class="content">
  <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>REPORTS BY DATE</i></b></h2><br>
</div>

  <div class="row">
    <div class="col-md-2"></div>

    <div class="col-md-3">
        <div class="form-group">
          <label for="select21"><h4>Choose Supplier</h4></label>
            
            <select name="supplier" id="select21" class="form-control select2
             supplier " style="width:100%">
               <option></option>
                <optgroup >
                     <?php
                    $select_sup = "SELECT * FROM suppliers ";
                    $run_sup = mysqli_query($connection,$select_sup);
                    while($row = mysqli_fetch_array($run_sup))
                    {
                      echo "<option value=".$row['name']."  >". $row['name'] ."</option>";
                    }
                    ?> 
                </optgroup> 
            </select>
        </div>
    </div>


    <div class="col-md-3" >
        <div class="form-group">
           <label for="select21"><h4>Choose Company</h4></label>
            <select name="company" id="select22" class="form-control select2 company" style="width:100%">
               <option></option>
                <optgroup >
                     <?php
                    $select_sup = "SELECT * FROM company ";
                    $run_sup = mysqli_query($connection,$select_sup);
                    while($row = mysqli_fetch_array($run_sup))
                    {
                      echo "<option value=".$row['name']."  >". $row['name'] ."</option>";
                    }
                    ?> 
                </optgroup> 
            </select> 
          
        </div>
    </div>


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
</form>
<br>


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
      </div>

 

       <div class="col-md-12">
          
<table class="table table-striped table-bordered table-hover" id="sample_1">
                          <thead>
                          <tr class="bg-primary">

                            <th>#</th>
                            <th>Supplier Name</th> 
                            <th>Batch No: </th> 
                            <th>Product: </th>
                            <th>Company: </th>
                            <th>Purchase Price</th>
                            <th>Qunatity</th>
                            <th>Total</th>
                            <th>Date</th>
                            

                          </tr>                             
                          </thead>
                          <tbody id="display" >
                          <?php      

                          $supp_com = "SELECT GROUP_CONCAT(purchase.batch_no) AS batch , GROUP_CONCAT(purchase.pur_price) AS purchase_price, GROUP_CONCAT(purchase.quantity) AS quantities, GROUP_CONCAT(purchase.total_price) AS total_price , GROUP_CONCAT(purchase.date) AS dates, GROUP_CONCAT(product.title) AS product_name , suppliers.name AS supplier_name , GROUP_CONCAT(company.name) AS company_name FROM purchase JOIN product JOIN suppliers JOIN company WHERE purchase.product_id = product.id AND purchase.supplier_id = suppliers.id AND product.company = company.id GROUP by suppliers.name ";

                            $run = mysqli_query($connection,$supp_com);
                            while($row=mysqli_fetch_array($run))
                            {

                              $serial++;

                                $batch_no = $row['batch'];
                                $batch_exp=explode(',', $batch_no);

                                $supp_name = $row['supplier_name'];
                               
                                  $product = $row['product_name'];
                                  $pro_exp=explode(',', $product);

                                  $company_name = $row['company_name'];
                                  $com_exp=explode(',', $company_name);

                                                                   
                                  $purchase = $row['purchase_price'];
                                  $pur_exp=explode(',', $purchase);

                                  $quantity = $row['quantities'];
                                  $qua_exp=explode(',', $quantity);

                                  $total = $row['total_price'];
                                  $tot_exp=explode(',', $total);

                                  $date = $row['dates'];

                                  $date_exp=explode(',', $date);
                                //$newDate = date("d-m-Y", strtotime($date));


                                  $output = '
                                      <tr>

                                        <td>'.$serial.'</td>
                                        <td>'.$supp_name.'</td>
                                        

                                        <td>';
                                          foreach($batch_exp as $result11)
                                          {
                                            $output.=$result11."<br><br>";
                                          }    
                                        $output.='</td>
                                          
                                        <td>';
                                          foreach($pro_exp as $result1)
                                          {
                                            $output.=$result1."<br><br>";
                                          }    
                                        $output.='</td>

                                        <td>';


                                          foreach($com_exp as $result2)
                                          {
                                            $output.=$result2."<br><br>";
                                          }    
                                        $output.='</td>

                                        <td>';
                                          foreach($pur_exp as $result3)
                                          {
                                            $output.=$result3."<br><br>";
                                          }    
                                        $output.='</td>

                                        <td>';
                                          foreach($qua_exp as $result4)
                                          {
                                            $output.=$result4."<br><br>";
                                          }    
                                        $output.='</td>

                                        <td>';
                                          foreach($tot_exp as $result5)
                                          {
                                            $output.=$result5."<br><br>";
                                          }    
                                        $output.='</td>


                                        <td>';
                                          foreach($date_exp as $result6)
                                          {
                                            $output.=$result6."<br><br>";
                                          }    
                                        $output.='</td>
   </tr>
                                      ';
                                    echo $output;
                              
                              }//while (supp,com, date)  ?>
                          </tbody>
                      </table>
                  </div>
           
          </div>
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


$('.supplier').change(function()
{
  //var input = $('.name').val();
  var input1=  $('.supplier').find(':selected').text();
  

  if(input1)
  {
    $.ajax({
      type : 'POST',
      url : 'all_sup_process.php',
      data  : {name:input1},
      success : function (data)
      {
        var some_data=$("#display").html(data);

        //$('#supply').remove();         
      }
    });
  }

});


$('.company').change(function()
{
  //var input = $('.name').val();
  var input2=  $('.company').find(':selected').text();
  
  if(input2)
  {
    $.ajax({
      type : 'POST',
      url : 'all_com_process.php',
      data  : {name:input2},
      success : function (data)
      {
        var some_data=$("#display").html(data);

        //$('#supply').remove();         
      }
    });
  }

});



$('.supplier').change(function()
{
  $('.company').change(function()
  {
    
    var company=  $('.company').find(':selected').text();
    var supplier=  $('.supplier').find(':selected').text();
  
    
      $.ajax({
        type : 'POST',
        url : 'all_sup_com_process.php',
        data  : {company:company,supplier:supplier},
        success : function (data)
        {
          var some_data=$("#display").html(data);         
        }
      });
    

  });

});

$('.supplier').change(function()
{
  $('.company').change(function()
  {

$('#date1').change(function()
{
  $('#date2').change(function()
  {
    var start_date = $('#date1').val();
    var end_date = $('#date2').val();
    var company=  $('.company').find(':selected').text();
    var supplier=  $('.supplier').find(':selected').text();
  
    
      $.ajax({
        type : 'POST',
        url : 'all_report_process.php',
        data  : {company:company,supplier:supplier,start_date:start_date,end_date:end_date},
        success : function (data)
        {
          var some_data=$("#display").html(data);         
        }
      });
    

  });

});
});
});


});
</script>
<script type="text/javascript">
document.onkeyup = function(e) {

if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
</body>
</html>