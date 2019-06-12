<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if(isset($_POST['name']))
 {
	$name = $_POST['name'];
	// $select_name = "SELECT suppliers.id, suppliers.name, purchase.supplier_id, purchase.id,   purchase.product_id, purchase.sale_price, purchase.quantity, purchase.bonus, purchase.batch_no, purchase.date FROM suppliers JOIN purchase WHERE purchase.supplier_id = suppliers.id AND  suppliers.name = '$name' ";

  $select_name = 	"SELECT purchase.pur_price, purchase.sale_price, purchase.quantity, purchase.quantity, purchase.bonus, purchase.total_price, purchase.batch_no, purchase.date, product.title, suppliers.name FROM purchase JOIN product JOIN suppliers WHERE purchase.product_id = product.id AND purchase.supplier_id = suppliers.id AND suppliers.name   = '$name' ";

	
	$run_name = mysqli_query($connection,$select_name);
	while($row=mysqli_fetch_array($run_name))
	{



		$serial++;

		$name = $row['name'];
		$batch_no = $row['batch_no'];
		$product = $row['title'];
		$price = $row['pur_price'];
		$quantity = $row['quantity'];
		$bonus = $row['bonus'];
	
		// $company = $row['company'];
		$date = $row['date'];
		$newDate = date("d-m-Y", strtotime($date));

		$total = $row['total_price'];
		//$grand_total = $row['grand'];

		//$total =  $price * $quantity;
		$output = '
		<tr>
            <td>'.$serial.'</td>
            <td>'.$name.'</td>
            <td>'.$batch_no.'</td>
            <td>'.$product.'</td>
            <td>'.$price.'</td>
            <td>'.$quantity.'</td>
            <td>'.$bonus.'</td>
            <td>'.$total.'</td>
            <td>'.$newDate.'</td>
        </tr>
		';
	echo $output;
}

}
?>