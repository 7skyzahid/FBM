<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if( isset($_POST['start_date']) && isset($_POST['end_date']))
 {
	$start_date = $_POST['start_date'];
  	$end_date = $_POST['end_date'];

  	// $select_name = "SELECT product.title as title, suppliers.name as name,  stock_items.product_id ,stock_items.expiry_date,  stock_items.quantity, stock_items.pur_price, stock_items.total_price,stock_items.batch,stock_items.supplier_id, stock_items.date  FROM stock_items  JOIN product JOIN suppliers WHERE  stock_items.product_id = product.id AND stock_items.supplier_id = suppliers.id AND $name = month(stock_items.expiry_date)" ;

  	$select_name = "SELECT product.title as title, suppliers.name as name,  stock_items.product_id ,stock_items.expiry_date,  stock_items.quantity, stock_items.pur_price, stock_items.total_price,stock_items.batch,stock_items.supplier_id, stock_items.date  FROM stock_items  JOIN product JOIN suppliers WHERE  stock_items.product_id = product.id AND stock_items.supplier_id = suppliers.id  AND stock_items.expiry_date BETWEEN '$start_date' AND '$end_date' ";

	
	$run_name = mysqli_query($connection,$select_name);
	while($row=mysqli_fetch_array($run_name))
	{
		$serial++;
        $product_name = $row['title']; 
        $expiry = $row['expiry_date'];
        $exDate = date("d-m-Y", strtotime($expiry));

        $quantity = $row['quantity'];
        $pur_price = $row['pur_price'];
        $total_price = $row['total_price'];
        $batch_no = $row['batch'];
        $supplier_name = $row['name'];
        $date = $row['date'];
        $newDate = date("d-m-Y", strtotime($date));

		$output = '
		<tr>
            <td>'.$serial.'</td>
            <td>'.$exDate.'</td>
            <td>'.$supplier_name.'</td>
            <td>'.$batch_no.'</td>
            <td>'.$product_name.'</td>
            <td>'.$pur_price.'</td>
            <td>'.$quantity.'</td>
            <td>'.$total_price.'</td>
            <td>'.$newDate.'</td>
        </tr>
		';
	echo $output;
}

}
?>