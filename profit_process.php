<?php
include 'includes/db.php';
$output = "" ;
$serial = 0;
$total=0;

if(  isset($_POST['start_date']) && isset($_POST['end_date']) )
 {

	$start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  

  $profit = "SELECT profit.created_date AS dates , GROUP_CONCAT( DISTINCT profit.name ORDER BY profit.name ASC SEPARATOR '<br><br>' ) AS names ,GROUP_CONCAT(profit.description) AS descr , SUM(profit.debit) AS debits,SUM(profit.credit) AS credits FROM profit WHERE profit.created_date BETWEEN '$start_date' AND '$end_date'  GROUP by profit.created_date order by profit.name ASC ";
  $run = mysqli_query($connection,$profit);
  while($row = mysqli_fetch_array($run))
  {
    $serial = $serial + 1;

    $name = $row['names'];
    $name_sup=explode(',', $name);

    $description = $row['descr'];
    $debit = $row['debits'];
    $credit = $row['credits'];
    $date = $row['dates'];
    $newDate2 = date("d-m-Y", strtotime($date));

    $total = $debit - $credit;
        
  $output = '
		
		<tr>

		  <td>'.$serial.'</td>
      <td>'.$newDate2.'</td>
		  
      <td>';
      foreach($name_sup as $result1)
      {
        $output.=$result1."<br>";
      }    
      $output.='</td>

      <td>'.$debit.'</td>
      <td>'.$credit.'</td>
      <td>'.$total.'</td>
     
 
    </tr>
		';
	echo $output;
		
	}
}
?>