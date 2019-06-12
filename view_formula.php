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

<div class="box-header with-border">
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>FORMULA INFORMATION</i></b></h2><br>
</div>
   
    <div class="col-md-10">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Formula Detail</span>
       </strong>
      </div>
        <div class="panel-body">
         <table class="table table-bordered table-striped table-hover">
           
             <th  class="text-center" ><?php 
             if (isset($_GET['name'])) {
                echo  $for=$_GET['name'];
                    
               }
             ?></th>
           
         </table>

          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    
                    <th>Item</th>
                    <th>Item Code</th>
                    <th>KG</th>
                    <th>Price Per KG</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1;
              
$que1="SELECT * FROM formula  WHERE formula_name='$for'";
$res1=mysqli_query($connection,$que1);
while ($row=mysqli_fetch_array($res1)) {
$id=$row['itemid']; 

                    $que2="SELECT title From materials  WHERE id='$id'";
                    $res2=mysqli_query($connection,$que2);
                    while ($row2=mysqli_fetch_array($res2)) {
                    $proname=$row2['title'];



                    ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $proname ; ?></td>
                    <td><?php echo $row['itemcode'] ; ?></td>
                    <td><?php echo $row['quantity'] ; ?></td>
                    <td><?php echo $row['price'] ; ?></td>
                    <td><?php echo $row['total'] ; ?></td>

                </tr>
              <?php }   } ?>
              <tr>
                <th colspan="2">Price Per KG</th>
                    <th> Total KG</th>
                    <th>Total Amount</th>
              </tr>

<?php 
$que3="SELECT * FROM formula_grand  WHERE formula_name='$for'";
$res3=mysqli_query($connection,$que3);
while ($row3=mysqli_fetch_array($res3)) {
 

?>

              <tr>
                <td colspan="2"><?php echo $row3['costperkg'] ; ?></td>
                <td><?php echo $row3['grand_kg'] ; ?></td>
                <td><?php echo $row3['grand_amount'] ; ?></td>
              </tr>

            <?php } ?>
            </tbody>
          </table>
<div class="form-group form-actions">
<div class="col-md-6 col-md-offset-5">
<br>
<a href="add_formula2.php" class="button button-royal btn_3d ">Cancel</a>

</div>
</div>
       </div>
    </div>
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
<script src="vendors/select2/js/select2.js" type="text/javascript"></script>

<!-- end of page level js -->
</body>
</html>




</script>
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "add_formula2.php";
}
};
</script>
