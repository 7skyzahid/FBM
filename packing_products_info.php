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
<h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>PACKING INFORMATION</i></b></h2><br>
</div>
   <div class="row" >
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Packing Information</span>
         </strong>
        </div>
        <div class="panel-body">
<form method="post" >
<div class="row" >
<div class="col-md-6"><div class="form-group">
      <label><b> Packing   Name</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="packing"  placeholder="Packing Name" required>
</div></div>

<div class="col-md-6"><div class="form-group">
      <label><b> Packing Code</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="code"  placeholder="Packing Code" required>
</div></div>

</div>


<div class="row" >
<div class="col-md-6"><div class="form-group">
      <label><b> Gram-</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="quantity"  placeholder="Quantity In Gram/-" required>
</div></div>

<div class="col-md-6"><div class="form-group">
      <label><b> Cost</b><span class="text-danger">*</span></label>
<input type="text"  class="form-control input-sm" name="price"  placeholder="Cost per Gram " required>
</div></div>

</div>

<div class="row" >
 <div class="col-md-6">
  <div class="form-group">
    
       <label><b>Chose Formula </b><span class="text-danger">*</span></label>
<select name="formula" id="select2" class="form-control select2 " required>
         <option value="">Choose</option>
          <optgroup >
              <?php
               $query4="SELECT * FROM formula";
               $db4=mysqli_query($connection,$query4);
               while ($row4=mysqli_fetch_array($db4)) {?>
                 <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['name']; ?> </option>
               <?php }
              ?> 
          </optgroup> 
      </select>
  </div>
</div>
 <div class="col-md-6">
  <div class="form-group">
    
       <label><b>Chose Group </b><span class="text-danger">*</span></label>
<select name="group" id="select2" class="form-control select2 " required>
         <option value="">Choose</option>
          <optgroup >
              <?php
               $query4="SELECT * FROM groups";
               $db4=mysqli_query($connection,$query4);
               while ($row4=mysqli_fetch_array($db4)) {?>
                 <option value="<?php echo $row4['id']; ?>"> <?php echo $row4['title']; ?> </option>
               <?php }
              ?> 
          </optgroup> 
      </select>
  </div>
</div>
 </div>


<div class="row" >

  <div class="col-md-6">
<div class="form-check">
<label class="form-check-label" for="radio1">
  <input type="radio" class="form-control" id="radio1" name="optradio" value="Plastic" checked>
  <b>Plastic</b>
</label>
</div>
</div>

<div class="col-md-6">
    <div class="form-check">
      <label class="form-check-label" for="radio2">
        <input type="radio" class="form-control" id="radio2" name="optradio" value="Cotton">
        <b>Cotton</b>
      </label>
    </div>
</div>
</div>
<br>

<div  align="center">
<input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
<a href="index.php" class="btn btn-danger  btn-md ">CANCEL </a>
</div>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Packings</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Packing</th>
                    <th>Item Code </th>
                    <th>Grams</th>
                    <th>Cost</th>
                    <th>Type</th>
                    <th>Formula</th>
                    <th>Group</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1; 
$que1="SELECT  packings.id,  packings.name, packings.quantity, packings.price, packings.code,packings.type,
formula.name AS formu , groups.title

FROM packings

INNER JOIN  formula ON  packings.formula_id=formula.id
INNER JOIN   groups ON  packings.group_id=groups.id";
$res1=mysqli_query($connection,$que1);
                  while ($row=mysqli_fetch_array($res1)) {
                    ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $row['name'] ; ?></td>
                    <td><?php echo $row['code'] ; ?></td>
                    <td><?php echo $row['quantity'] ; ?></td>
                    <td><?php echo $row['price'] ; ?></td>
                    <td><?php echo $row['type'] ; ?></td>
                    <td><?php echo $row['formu'] ; ?></td>
                    <td><?php echo $row['title'] ; ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="update_formula.php?gid=<?php echo $row['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="add_formula.php?id=<?php echo $row['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
   </div>
</div>

<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
$que2="DELETE FROM `packings` WHERE id='$id'";
$res2=mysqli_query($connection,$que2);
if($res2){
   echo' <script>window.location.href = "add_packing.php";</script>';
}
}?>





<?php
if (isset($_POST['save'])) {
      $title = $_POST['packing'];
    $formula = $_POST['formula'];
    $code = $_POST['code'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $product = $_POST['product'];
    $group = $_POST['group'];
    $type = $_POST['optradio'];


    $total=$quantity*$price;

$query ="INSERT INTO `packings`( `name`, `quantity`, `price`,`code`, `type`, `formula_id`, `group_id`)
         VALUES  ('$title','$quantity','$price','$code','$type','$formula','$group')";
    $result = mysqli_query($connection, $query);
    if($result){
   echo' <script>window.location.href = "add_packing.php";</script>';
}
   }
?>


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

<script type="text/javascript">
  $(document).ready(function(){

    $(".select2").select2({
            theme: "bootstrap",
            placeholder: "Select"
        });
});


</script>
<script type="text/javascript">
document.onkeyup = function(e) {
if (e.which == 13) {
  document.getElementById("save").click();
}
if (e.which == 27) {
window.location.href = "index.php";
}
};
</script>
