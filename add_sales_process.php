<?php
include 'includes/db.php';

if(isset($_POST['product_id']))
 {
	$product_id= $_POST['product_id'];
	
	
	$select_item = "SELECT id,product_id,quantity,sale_price
                                                 FROM `stock_items` 
                                                 WHERE product_id='$product_id' AND
                                                       quantity>0
                                                 ORDER BY expiry_date ASC LIMIT 1 ";
	$run_item = mysqli_query($connection,$select_item);
	while($row=mysqli_fetch_array($run_item))
	{
		$fetch_id = $row['id'];
		
		$sale_price = $row['sale_price'];
		$quantity=$row['quantity'];
		$data = ["id"=>$fetch_id,  "quantity"=>$quantity, "price" => $sale_price];
	}
	echo json_encode($data);
}
?>






