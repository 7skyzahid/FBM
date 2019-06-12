<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if(isset($_POST['name']))
 {
	$name_search = $_POST['name'];
	// $select_name = "SELECT suppliers.id, suppliers.name, purchase.supplier_id, purchase.id,   purchase.product_id, purchase.sale_price, purchase.quantity, purchase.bonus, purchase.batch_no, purchase.date FROM suppliers JOIN purchase WHERE purchase.supplier_id = suppliers.id AND  suppliers.name = '$name' ";

  $select_name = 	"SELECT  purchase.batch_no, suppliers.name, group_concat(product.title) as product_name, GROUP_CONCAT(purchase.pur_price) as purchase_price, GROUP_CONCAT(purchase.sale_price) as sale_price, GROUP_CONCAT(purchase.quantity) as quantities, GROUP_CONCAT(purchase.bonus) as total_bonus, GROUP_CONCAT(purchase.total_price) as total_price, group_concat(purchase.date) as dates FROM purchase JOIN product JOIN suppliers WHERE purchase.product_id = product.id AND purchase.supplier_id = suppliers.id AND suppliers.name = '$name_search' GROUP by batch_no";

	
	$run_name = mysqli_query($connection,$select_name);
	while($row=mysqli_fetch_array($run_name))
	{

		$serial++;

		  $batch_no = $row['batch_no'];
		  $name = $row['name'];
		 

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
		
		$out = '<h3> '.$name.' </h3>';

		$output = '
		
		<tr>

		  <td>'.$serial.'</td>
		  <td>'.$batch_no.'</td>

	      
	      <td>';
          foreach($pro_exp as $result1)
          {
            $output.=$result1."<br>";
          }    
	      $output.='</td>

	      <td>';


          foreach($pur_exp as $result2)
          {
            $output.=$result2."<br>";
          }    
	      $output.='</td>

	      <td>';
          foreach($qua_exp as $result3)
          {
            $output.=$result3."<br>";
          }    
	      $output.='</td>

	      <td>';
          foreach($tot_exp as $result4)
          {
            $output.=$result4."<br>";
          }    
	      $output.='</td>


	      <td>';
          foreach($date_exp as $result5)
          {
            $output.=$result5."<br>";
          }    
	      $output.='</td>
	
	      
            
        </tr>
		';
	echo $output;

	}

}
?>