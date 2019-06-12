<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if(isset($_POST['name']))
 {
	$name = $_POST['name'];

	$select_name = " SELECT  GROUP_CONCAT(product.title) as product_name ,GROUP_CONCAT(stock_items.quantity) as total_quantity , GROUP_CONCAT(stock_items.pur_price) as purchase_price , GROUP_CONCAT(stock_items.total_price) as total_prices ,GROUP_CONCAT(stock_items.batch) as batch_num ,stock_items.date as dates, GROUP_CONCAT(company.name) as name FROM stock_items JOIN product JOIN company WHERE stock_items.product_id = product.id AND product.company = company.id AND company.name = '$name' group by stock_items.date";
	$run_name = mysqli_query($connection,$select_name);
	while($row=mysqli_fetch_array($run_name))
	{
		$serial = $serial + 1;

    $company_name = $row['name'];
    $com_exp=explode(',', $company_name);


    $batch = $row['batch_num'];
    $b_exp=explode(',', $batch);

    $product_name = $row['product_name'];
    $pro_exp=explode(',', $product_name);

    $purchase_price = $row['purchase_price'];
    $pur_exp=explode(',', $purchase_price);

    $total_quantity = $row['total_quantity'];
    $tot_exp=explode(',', $total_quantity);

    $total_price = $row['total_prices'];
    $pri_exp=explode(',', $total_price);

    $date = $row['dates'];
    $newDate = date("d-m-Y", strtotime($date));
    
    



    $output = '
		
		<tr>

		  <td>'.$serial.'</td>
		  

      <td>';
          foreach($com_exp as $result1)
          {
            $output.=$result1."<br>";
          }    
        $output.='</td>

        
		

	      
	      <td>';
          foreach($b_exp as $result2)
          {
            $output.=$result2."<br>";
          }    
	      $output.='</td>

	      <td>';


          foreach($pro_exp as $result3)
          {
            $output.=$result3."<br>";
          }    
	      $output.='</td>

	      <td>';
          foreach($pur_exp as $result4)
          {
            $output.=$result4."<br>";
          }    
	      $output.='</td>

	      <td>';
          foreach($tot_exp as $result5)
          {
            $output.=$result5."<br>";
          }    
	      $output.='</td>


	      <td>';
          foreach($pri_exp as $result6)
          {
            $output.=$result6."<br>";
          }    
	      $output.='</td>



	
	      <td>'.$newDate.'</td>
            
        </tr>
		';
	echo $output;
		
	}
}
?>