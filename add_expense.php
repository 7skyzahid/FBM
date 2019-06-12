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
    <section class="content">

        <div class="content-wrapper animatedParent animateOnce">
            <div class="container" >
            <div class="box-header with-border" align="center">
            <h2 class="font-weight-bold mb-1"><b> <i>ADD EXPENSES</i></b></h2><br>
            </div>
               <div class="row" >
    <div class="col-md-9" style="margin-left:10%">
      <div class="panel panel-default" >
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add Expense </span>
         </strong>
        </div>
<div class="panel-body">
            <form method="POST" enctype="multipart/form-data">

            <div class="col-md-6"><div class="form-group">
                  <label><b>Category Expense</b><span class="text-danger">*</span></label>
                  <select class="form-control input-sm" name="expense_cat">
                      <option value="">Choose Category</option>
                      <?php
                      $select_cat = "SELECT * FROM expense_cat";
                      $run_cat = mysqli_query($connection,$select_cat);
                      while($row =mysqli_fetch_array($run_cat))
                      {
                        $id = $row['id'];
                        $name = $row['name'];
                        echo "<option value='$id'>$name</option>";
                      }?>
                  </select>
            </div></div>

              <div class="col-md-6">
              <div class="form-group">
                  <label><b>Expense Name </b><span class="text-danger">*</span></label>
                  <input type="text"  class="form-control input-sm" name="name"  placeholder="Enter Amount" >
              </div>
            </div>

                <div class="col-md-6">
              <div class="form-group">
                  <label><b>Amount</b><span class="text-danger">*</span></label>
                  <input type="text"  class="form-control input-sm" name="amount"  placeholder="Enter Amount" >
              </div>
            </div>


            <div class="col-md-6"><div class="form-group">
            <label><b>Person Name</b><span class="text-danger">*</span></label>
            <input type="text" class="form-control input-sm" name="per_name"  placeholder="Person Name" >
            </div></div>
           
                 <div class="col-md-6"><div class="form-group">
                  <label><b>Payment Method</b><span class="text-danger">*</span></label>
                  <select class="form-control input-sm" name="payment">
                      <option value="">Choose</option>
                      <option value="byCash">ByCash</option>
                      <option class="Omni">Omni</option>
                      <option value="EasyPaisa">EasyPaisa</option>
                      <option value="MobiCash">MobiCash </option>
                  </select>
                </div></div>
                
                <div class="col-md-6">
                    <label><b>Add Description</b><span class="text-danger">*</span></label>
                    <textarea class="form-control input-sm" name="desc" row="3">
                    </textarea>
                    </div>
<br><br><br>
                
                <div align="">
 <input type="submit" name="save" id="save" value="Save" class="btn btn-primary btn-md">
               
                   <a href="index.php" class="btn btn-danger btn-md ">CANCEL</a>
                    </div>
               

            </form>
              </div>
      </div>
    </div>
  </div>
            
            </div>
            </div>


            <?php
            if (isset($_POST['save'])) {

                $cat = $_POST['expense_cat'];
                $name = $_POST['name'];
                $amount = $_POST['amount'];
                $per_name = $_POST['per_name'];
                $payment = $_POST['payment'];
                $description = $_POST['desc'];
                $date = date('Y-m-d');
                
                //echo $cat.$name.$amount.$per_name.$payment.$description.$date;
              


               

            $query ="INSERT INTO expenses (expense_cat_id,name,amount,person_name,payment_method,description,date)
            VALUES ('$cat','$name','$amount','$per_name','$payment','$description','$date')";
            $result = mysqli_query($connection, $query);
            if($result)
            {
                echo "Expense Added !";
                
            }else
            {
                echo "Something Wrong ! ";
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
<!-- end of page level js -->
</body>
</html>
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