<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if(isset($_POST['name']))
 {
	$name_search = $_POST['name'];
	// $select_name = "SELECT suppliers.id, suppliers.name, purchase.supplier_id, purchase.id,   purchase.product_id, purchase.sale_price, purchase.quantity, purchase.bonus, purchase.batch_no, purchase.date FROM suppliers JOIN purchase WHERE purchase.supplier_id = suppliers.id AND  suppliers.name = '$name' ";

  $select_name = 	"SELECT  GROUP_CONCAT(product.title) as product_name ,GROUP_CONCAT(stock_items.quantity) as quantities , GROUP_CONCAT(stock_items.pur_price) as purchase_price , GROUP_CONCAT(stock_items.total_price) as total_price ,GROUP_CONCAT(stock_items.batch) as batch_no , GROUP_CONCAT(suppliers.name) as sup_name ,stock_items.date as dates FROM stock_items JOIN product JOIN suppliers WHERE stock_items.product_id = product.id AND stock_items.supplier_id = suppliers.id AND suppliers.name = '$name_search' group by stock_items.date ";

	
	$run_name = mysqli_query($connection,$select_name);
	while($row=mysqli_fetch_array($run_name))
	{

		$serial++;

		  $batch_no = $row['batch_no'];
		  $batch_exp=explode(',', $batch_no);

		  $sup_name = $row['sup_name'];
		  $sup_exp=explode(',', $sup_name);
		 

	      $product = $row['product_name'];
	      $pro_exp=explode(',', $product);

	                                       
	      $purchase = $row['purchase_price'];
	      $pur_exp=explode(',', $purchase);

	      $quantity = $row['quantities'];
	      $qua_exp=explode(',', $quantity);

	      $total = $row['total_price'];
	      $tot_exp=explode(',', $total);

	      $date = $row['dates'];
	      $date_exp=explode(',', $date);
		//$newDate = date("d-m-Y", strtotime($date));
		
		$out = '<h3> '.$sup_name.' </h3>';

		$output = '
		
		<tr>

		  <td>'.$serial.'</td>

		  <td>';
          foreach($batch_exp as $result1)
          {
            $output.=$result1."<br><br>";
          }    
	      $output.='</td>

	     
		  

	      
	      <td>';
          foreach($pro_exp as $result2)
          {
            $output.=$result2."<br><br>";
          }    
	      $output.='</td>

	      <td>';


          foreach($pur_exp as $result3)
          {
            $output.=$result3."<br><br>";
          }    
	      $output.='</td>

	      <td>';
          foreach($qua_exp as $result4)
          {
            $output.=$result4."<br><br>";
          }    
	      $output.='</td>

	      <td>';
          foreach($tot_exp as $result5)
          {
            $output.=$result5."<br><br>";
          }    
	      $output.='</td>


	      <td>';
          foreach($date_exp as $result6)
          {
            $output.=$result6."<br><br>";
          }    
	      $output.='</td>
	
	      
            
        </tr>
		';
	echo $output;

	}

}
?>