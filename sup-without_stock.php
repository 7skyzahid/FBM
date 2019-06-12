<?php
include 'includes/db.php';

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
<!-- <div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div> -->
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php' ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php' ?>

<aside class="right-side">
   
<section class="content">
  <div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>SUPPLIER REPORT (Without Stock)</i></b></h2><br>
</div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="select21"><h4>Choose Supplier</h4></label>
              
              <select name="name" id="select21" class="form-control select2 name" style="width:100%">
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

         <div class="col-md-4"></div> 
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


            <h4>Supplier Name:   <span id="shows">  </span> </h> 



          </div>

          <div class="col-md-2"></div>

          <div id="div3"  class="col-md-3 " style="margin-top: 45px">
            <h5><strong>Supplier Report <br>( Report Date: )</strong></h5>
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
                                
                                $select = "SELECT  batch_no, group_concat(product.title) as product_name, GROUP_CONCAT(purchase.pur_price) as purchase_price, GROUP_CONCAT(purchase.sale_price) as sale_price, GROUP_CONCAT(purchase.quantity) as quantities, GROUP_CONCAT(purchase.bonus) as total_bonus, GROUP_CONCAT(purchase.total_price) as total_price,suppliers.name, date FROM purchase JOIN product JOIN suppliers WHERE purchase.product_id = product.id AND purchase.supplier_id = suppliers.id GROUP by batch_no";
                                $run = mysqli_query($connection,$select);

                                while($row = mysqli_fetch_array($run))
                                {
                                  $serial++;
                                  $batch_no = $row['batch_no'];
                                  $name = $row['name'];

                                  $product = $row['product_name'];
                                  $pro_exp=explode(',', $product);
                                                                   
                                  $purchase = $row['purchase_price'];
                                  $pur_exp=explode(',', $purchase);

                                  $quantity = $row['quantities'];
                                  $qua_exp=explode(',', $quantity);

                                  $total = $row['total_price'];
                                  $tot_exp=explode(',', $total);

                                  $date = $row['date'];
                                
                                ?>
                                <tr>
                                  <td><?php echo $serial; ?></td>
                                  <td id="name"><?php echo $name; ?></td> 
                                  <td><?php echo $batch_no; ?></td>

                                  <td>
                                  <?php 
                                    foreach($pro_exp as $result1)
                                    {
                                      echo "" .$result1."<br><br>";
                                    } 
                                  ?>
                                  </td>
                                  
                                  <td>
                                    <?php 
                                      foreach($pur_exp as $result2)
                                      {
                                        echo "" .$result2."<br><br>";
                                      } 
                                    ?>    
                                  </td>

                                  <td>
                                    <?php 
                                      foreach($qua_exp as $result3)
                                      {
                                        echo "" .$result3."<br><br>";
                                      } 
                                    ?>    
                                  </td>


                                  <td>
                                    <?php 
                                      foreach($tot_exp as $result4)
                                      {
                                        echo "" .$result4."<br><br>";
                                      } 
                                    ?>    
                                  </td>
                                  

                                  <td><?php echo $date; ?></td>
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

<!-- <script src="js/autosearch/jquery.min-3.1.0.js"></script>
<script src="js/autosearch/bootstrap3-typeahead.min.js"></script> 
<script src="vendors/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="vendors/select2/js/select2.js" type="text/javascript"></script>
<script src="vendors/selectize/js/standalone/selectize.min.js" type="text/javascript"></script>
<script src="vendors/iCheck/js/icheck.js" type="text/javascript"></script>
<script src="vendors/selectric/js/jquery.selectric.min.js" type="text/javascript"></script>
<script src="js/custom_js/custom_elements.js" type="text/javascript"></script>


<script type="text/javascript" src="vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="js/custom_js/datatables_custom.js"></script> -->

<script>

$(document).ready(function(){
  $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });

 // $('#sample_1').DataTable( {
 //        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
 //    } );

});

$(document).ready(function(){

 $('#name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"search_suppliers.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {



     result($.map(data, function(item){
      
      return item;
     }));
    }
   })
  }
 });


$('#select21').change(function()
{
    //var input = $('.name').val();

    var input=  $('.name').find(':selected').text();
    
    $('#shows').text(input);

    if(input)
    {
      $.ajax({
        type : 'POST',
        url : 'sup_without_stock_process.php',
        data  : {name:input},
        success : function (data)
        {
          var some_data=$("#display").html(data);
          $('#supply').remove();         
        }
      });
    }
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
