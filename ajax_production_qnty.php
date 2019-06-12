<?php
include 'includes/db.php';

$y="yes";
$n="no";

if(isset($_POST['formula']) && isset($_POST['quantity']))
 {
 	$forId    =$_POST['formula'];
    $reqQnty  =$_POST['quantity'];


$queryx = " SELECT formula_name FROM formula_grand  WHERE id='$forId' ";
  $resultx= mysqli_query($connection,$queryx);

while ($fetchx=mysqli_fetch_array($resultx)) {
    $formula_name=$fetchx['formula_name'];

$query = " SELECT * FROM formula  WHERE formula_name='$formula_name' ";
  $result= mysqli_query($connection,$query);

while ($fetch=mysqli_fetch_array($result)) {
    $formu_item_id=$fetch['itemid'];
    $formu_item_qnty=$fetch['quantity'];
    
// claculate ecah raw material quantity in production 
    $rawQnty= $reqQnty * $formu_item_qnty;


$query1 = " SELECT * FROM raw_material_purchase  WHERE product_id='$formu_item_id' ";
  $result1= mysqli_query($connection,$query1);

while ($fetch1=mysqli_fetch_array($result1)) {
     $rawfinqnty=$fetch1['quantity'];

if ( $rawQnty > $rawfinqnty ) {


    		$data = ["ans"=>$n];
    
}

else {


    		$data = ["ans"=>$y];
    
}




}
}
}


	echo json_encode($data);
}
?>






