<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php'; ?>
</head>

<body class="skin-default">
<div class="preloader">
    <div class="loader_img"><img src="img/loader.gif" alt="loading..." height="64" width="64"></div>
</div>
<!-- header logo: style can be found in header-->
<?php include 'includes/header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
<?php include 'includes/menu.php'; ?>

<aside class="right-side">

    <section class="content">

        <div class="content-wrapper animatedParent animateOnce">
            <div class="container" >
            <div class="box-header with-border">
            <h2 style="text-align: center;" class="font-weight-bold mb-1"><b> <i>CLINICK INFORMATION</i></b></h2><br>
            </div>
               <div class="row" >

<div class="col-md-12" >
    <div class="panel panel-default" style="margin-left:3%">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Information</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Main Title </th>
                    <th>Clinic Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Hospital</th>
                    <th>Address</th>
                    <th>Logo</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php  $count=1; 
              $que1="SELECT * FROM `clinic_info`";
              $res1=mysqli_query($connection,$que1);
                  while ($row=mysqli_fetch_array($res1)) { 
                    ?>
                <tr>
                    <td class="text-center"><?php echo $count++ ; ?></td>
                    <td><?php echo $row['title'] ; ?></td>
                    <td><?php echo $row['name'] ; ?></td>
                    <td><?php echo $row['email'] ; ?></td>
                    <td><?php echo $row['phone'] ; ?></td>
                    <td><?php echo $row['hospital'] ; ?></td>
                    <td><?php echo $row['address'] ; ?></td>
                    <td><img src="<?php echo $row['img'] ;?>"  height="64" width="64"></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="add_lab_info.php?gid=<?php echo $row['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="add_lab_info.php?id=<?php echo $row['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
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
<?php
if (isset($_GET['gid'])) {
    $gid=$_GET['gid'];

  $que2="SELECT * FROM `clinic_info` WHERE id='$gid'";
              $res2=mysqli_query($connection,$que2);
                  while ($row2=mysqli_fetch_array($res2)) { ?>

    <div class="col-md-10">
      <div class="panel panel-default" style="margin-left:10%">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Update Clinic Information</span>
         </strong>
        </div>
<div class="panel-body">
            <form method="POST" enctype="multipart/form-data">
            
            <div class="row" >
            <div class="col-md-6"><div class="form-group">
                  <label><b>Clinick Main Title</b><span class="text-danger">*</span></label>
            <input type="text"  class="form-control input-sm" name="title" value="<?php echo $row2['title'];?>" >
            </div></div>

            <div class="col-md-6"><div class="form-group">
                  <label><b>Clinick Name</b><span class="text-danger">*</span></label>
            <input type="text"  class="form-control input-sm" name="labname" value="<?php echo $row2['name'];?>" >
            </div>
            </div>
            </div>
            <!-- first row ends  -->
            <div class="row" >
            <div class="col-md-6"><div class="form-group">
                  <label><b>Email Address</b><span class="text-danger">*</span></label>
            <input type="email" class="form-control input-sm" name="email" value="<?php echo $row2['email'];?>"  >
            </div></div>
            <div class="col-md-6"><div class="form-group">
                  <label><b>Mobile/Phone</b><span class="text-danger">*</span></label>
            <input type="text" class="form-control input-sm" name="phone" value="<?php echo $row2['phone'];?>"  >
            </div></div>
            </div>


            <div class="row" >
            
            <div class="col-md-6"><div class="form-group">
              <label><b>Chose New Lab Logo</b><span class="text-danger">*</span></label>
            <input type="file"  name="userfile"   >
            </div></div>
            <div class="col-md-6"><div class="form-group">
              <label><b>old Lab Logo</b><span class="text-danger">*</span></label>
            <img height="64" width="64" src="<?php echo $row2['img'];?>">
            </div></div>
            </div>

            <div class="row">
            <div class="col-md-6"><div class="form-group">
           <label><b>Associated Hospital Name</b><span class="text-danger">*</span></label>
           <input type="text"  name="hospital" class="form-control input-sm"  value="<?php echo $row2['hospital'];?>">
           </div></div>
            <div class="col-md-6"><div class="form-group">
            <label><b>Address</b><span class="text-danger">*</span></label>
            <input type="text"  class="form-control input-sm" name="address" value="<?php echo $row2['address'];?>">
            </div></div>
             </div>


            <br>


            <div  align="center">
            <input type="submit" name="save" id="save" value="Update" class="btn btn-primary btn-md">
            <a href="index.php" class="btn btn-danger btn-md ">CANCEL </a>
            </div>


</form>
</div>
</div>
</div>
<?php } } ?>

</div>
</div>
</div>
</section>
</aside>
</div>

<?php
if (isset($_GET['id'])) {
    $id=$_GET['id'];
$que2="DELETE FROM `clinic_info` WHERE id='$id'";
$res2=mysqli_query($connection,$que2);
if($res2){
   echo' <script>window.location.href = "add_lab_info.php";</script>';
}

}?>


            

            <?php
            if (isset($_POST['save'])) {

               $target=basename($_FILES['userfile']['name']);
                
                $img=$_FILES['userfile']['name'];

                $title = $_POST['title'];
                $labname = $_POST['labname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $hospital = $_POST['hospital'];
                $address = $_POST['address'];


               

            $query ="UPDATE clinic_info SET title='$title',name='$labname',email='$email',
            phone='$phone',hospital='$hospital',img='$img',address='$address' WHERE id='$gid'";

                $result = mysqli_query($connection, $query);
                if (move_uploaded_file($_FILES['userfile']['tmp_name'],$target )) {
                    echo " File uploaded";
                } else {
                    echo "no files uploaded";
                }
                
            if($result){
            echo' <script>window.location.href = "add_lab_info.php";</script>';
            }
            }

            // if (isset($_FILES['userfile'])) {
            //         $parameters=$_FILES['userfile'];
            //         echo $url=reset($parameters);

            // }

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
