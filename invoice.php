<?php
include 'includes/db.php';
if (isset($_GET['id'])) {
      $id= $_GET['id'];

$query=mysqli_query($connection,"SELECT * FROM stock_sales WHERE id='$id'");
while ($row=mysqli_fetch_array($query)) {
            $name=$row['customer'];
           $gtotal=$row['grand_total_amount'];
           $disc=$row['discount'];
           $afterdisc=$row['discounted_amount'];
           $paid=$row['paid_amount'];
           $due=$row['due_amount'];
           $date=$row['created_date'];
}
}
?>
  
<style >
  #invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding:2mm;
  margin: 0 auto;
  width: 70mm;
  background: #FFF;
  
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}

#top .logo{
  //float: left;
  height: 60px;
  width: 60px;
  background: url(Login-screen.jpg) no-repeat;

  background-size: 60px 60px;
}
.clientlogo{
  float: left;
  height: 60px;
  width: 60px;
  background: url(Login-screen.jpg) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  float:left;
  margin-left: 0;
}
td{
  padding: 5px 0 5px 15px;
  border: 1px solid #EEE
}

#legalcopy{
  margin-top: 5mm;
}

  
  
}
</style>
  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2>Zarak Medical Center</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <p> 
            Address : GT Road Aman Ghar,</br>
            Email   : asmaarif2@gmail.com</br>
            Phone   : 0300-555-5555</br>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    <hr>
  <div class="">
        <p> 
         Patient:<?php echo $name;?>  
         <!--Operator: zeshan   -->
        </p>
      </div>
    
    <hr>



    <div id="bot">
          <div id="table"  >
            <table  border="1">
              <thead>
              <tr>
                <th>S.N</th>
                <th>Item</th>
                <th>Qty</th>
                <th>Sub</th>
              </tr>
              </thead>
              <tbody>

<?php    $counter=0;
$query1=mysqli_query($connection,"SELECT * FROM sale_details 
              WHERE stock_sale_id='".$_GET['id']."' AND created_date='$date'");
           while ($row1=mysqli_fetch_array($query1)) {
            $stkid=$row1['stock_item_id'];
           $price=$row1['stock_single_price'];
           $quantity=$row1['quantity'];
  
  $query2=mysqli_query($connection,"SELECT * FROM stock_items WHERE id='$stkid' ");
           while ($row2=mysqli_fetch_array($query2)) {
           $proid= $row2['product_id'];        

$query3=mysqli_query($connection,"SELECT * FROM product WHERE id='$proid' ");
           while ($row3=mysqli_fetch_array($query3)) {
           $product= $row3['title'];
           $counter++;
            ?>
              <tr style="text-align: center;" >
                <td><?php echo $counter; ?></td>
                <td><?php echo $product; ?></td>
                <td><?php  echo $quantity   ;?></td>
                <td><?php  echo $price   ;?></td>
              </tr>
<?php  
} 
} } 
?>
<!-- <tr><td colspan="4"><hr></td></tr> -->

</tbody>

<tfoot>

              <tr>

                <td>Paid:</td>
                <td><?php echo $paid;?></td>
              </tr>

              <tr>
               <td>Dues:</td>
                <td><?php echo $due;?> </td>
                <td>Total:</td>
                <td><?php echo $gtotal;?></td>
              </tr>
</tfoot>
            </table>
          </div><!--End Table-->
<hr>
          <div id="legalcopy">
            <p class="legal"><strong>Thank you for your Payment!</strong></p>
          </div>

        </div><!--End InvoiceBot-->
  </div><!--End Invoice-->

<script src="js/app.js" type="text/javascript"></script>

  <script type="text/javascript">
              document.onkeyup = function(e) {

if (e.which == 13) {
window.print();
}
if (e.which == 27) {
window.location.href = "add_sales.php";
}
  };
            </script>