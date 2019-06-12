<?php
include 'includes/db.php';
?>
<?php

$request = mysqli_real_escape_string($connection, $_POST["query"]);
$query = "
 SELECT * FROM suppliers WHERE name LIKE '%".$request."%'
";
$result = mysqli_query($connection, $query);
$data = array();
if(mysqli_num_rows($result) > 0)
{
 while($row = mysqli_fetch_assoc($result))
 {
  $data[] = $row["name"];
  //$data[]=$row['student_id'];
 }
	echo json_encode($data);
}

//else
// {
// 	$new = "No Data"
// 	echo json_encode($new);
// }

?>