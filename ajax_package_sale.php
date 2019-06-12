<?php
include 'includes/db.php';

if(isset($_POST['package_id']))
 {
  $packid= $_POST['package_id'];
  
  $fetch2="SELECT * FROM package_amount WHERE id='$packid'";

  $get=mysqli_query($connection,$fetch2);
 
while ($result2=mysqli_fetch_array($get)) {
   $grand=$result2['grand'];

    $data = ["grand"=>$grand];
  }
  echo json_encode($data);

}
?>






