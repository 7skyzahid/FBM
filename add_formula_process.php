<?php
include 'includes/db.php';

if(isset($_POST['product_id']))
 {
	$product_id= $_POST['product_id'];
	
	
	$select_item = "SELECT * FROM `purchase`  WHERE product_id='$product_id'";
	$run_item = mysqli_query($connection,$select_item);

	while($row=mysqli_fetch_array($run_item))
	{
		
		$purchase = $row['pur_price'];
		$data = [ "price" => $purchase];
	}
	echo json_encode($data);
}
?>






