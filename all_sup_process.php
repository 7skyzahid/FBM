<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if(isset($_POST['name']))
 {
	$name_search = $_POST['name'];
	// $select_name = "SELECT suppliers.id, suppliers.name, purchase.supplier_id, purchase.id,   purchase.product_id, purchase.sale_price, purchase.quantity, purchase.bonus, purchase.batch_no, purchase.date FROM suppliers JOIN purchase WHERE purchase.supplier_id = suppliers.id AND  suppliers.name = '$name' ";

  $select_name = 	"SELECT GROUP_CONCAT(purchase.batch_no) AS batch , GROUP_CONCAT(purchase.pur_price) AS purchase_price, GROUP_CONCAT(purchase.quantity) AS quantities, GROUP_CONCAT(purchase.total_price) AS total_price , GROUP_CONCAT(purchase.date) AS dates, GROUP_CONCAT(product.title) AS product_name , suppliers.name AS supplier_name , GROUP_CONCAT(company.name) AS company_name FROM purchase JOIN product JOIN suppliers JOIN company WHERE purchase.product_id = product.id AND purchase.supplier_id = suppliers.id AND product.company = company.id AND suppliers.name = '$name_search'  GROUP by suppliers.name";

	
	$run_name = mysqli_query($connection,$select_name);
	
	while($row=mysqli_fetch_array($run_name))
                                {

                                  $serial++;

                                    $batch_no = $row['batch'];
                                    $batch_exp=explode(',', $batch_no);

                                    $supp_name = $row['supplier_name'];
                                   
                                      $product = $row['product_name'];
                                      $pro_exp=explode(',', $product);

                                      $company_name = $row['company_name'];
                                      $com_exp=explode(',', $company_name);

                                                                       
                                      $purchase = $row['purchase_price'];
                                      $pur_exp=explode(',', $purchase);

                                      $quantity = $row['quantities'];
                                      $qua_exp=explode(',', $quantity);

                                      $total = $row['total_price'];
                                      $tot_exp=explode(',', $total);

                                      $date = $row['dates'];

                                      $date_exp=explode(',', $date);
                                    //$newDate = date("d-m-Y", strtotime($date));


                                      $output = '
                                          <tr>

                                            <td>'.$serial.'</td>
                                            <td>'.$supp_name.'</td>
                                            

                                            <td>';
                                              foreach($batch_exp as $result11)
                                              {
                                                $output.=$result11."<br><br>";
                                              }    
                                            $output.='</td>
                                              
                                            <td>';
                                              foreach($pro_exp as $result1)
                                              {
                                                $output.=$result1."<br><br>";
                                              }    
                                            $output.='</td>

                                            <td>';


                                              foreach($com_exp as $result2)
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
                                  
                                  }//while (supp,com, date)

}
?>