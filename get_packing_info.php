<?php

if(isset($_GET['id']))
 {
  $id= $_GET['id'];
include 'includes/db.php';


$query5="SELECT * FROM packings WHERE id ='$id' ";
$db5=mysqli_query($connection,$query5);


while($row=mysqli_fetch_array($db5))
	{
		$id = $row['id'];
		$price = $row['price'];
		$quantity=$row['quantity'];
		$data = ["id"=>$id,  "quantity"=>$quantity, "price" => $price];
	}
	echo json_encode($data);



}

?>