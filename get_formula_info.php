<?php
include 'includes/db.php';

if(isset($_POST['product_id']))
 {
	$product_id= $_POST['product_id'];
	
	
	$select_item = "SELECT * FROM `formula_grand`  WHERE formula_name='$product_id'";
	$run_item = mysqli_query($connection,$select_item);

	while($row=mysqli_fetch_array($run_item))
	{
		
		$kg = $row['grand_kg'];
		$grand = $row['grand_amount'];
        $res=$grand/$kg;

		$data = [ "price" => $res];
	}
	echo json_encode($data);
}
?>






