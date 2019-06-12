<?php
include 'includes/db.php';

if(isset($_POST['product_id']))
 {
	$product_id= $_POST['product_id'];
	
	
	$select_item = "SELECT id,product_id,quantity,SUM(quantity) as total_quantity
                                                 FROM `stock_items` 
                                                 WHERE product_id='$product_id' AND
                                                       quantity>0
                                                   ";
	$run_item = mysqli_query($connection,$select_item);
	while($row=mysqli_fetch_array($run_item))
	{
		$fetch_id = $row['id'];
		
		$net_quantity=$row['total_quantity'];
		$data = ["id"=>$fetch_id,  "total_quantity"=>$net_quantity];
	}
	echo json_encode($data);
}
?>






