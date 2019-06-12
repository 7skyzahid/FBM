<?php
$conn= mysqli_connect('localhost','root','mysql','production');
    if(isset($_POST['place']))
    {    
         $place=$_POST['place'];
        $retrieve = mysqli_query($conn, "SELECT * FROM packings WHERE group_id LIKE '%$place%' ");
        
            while($rows = mysqli_fetch_array($retrieve))
            {
                $id = $row['id'];
                $name = $rows['name'];
                $price = $row['price'];
                $quantity=$row['quantity'];
                $code=$row['code'];


 echo '<td >
   
    <input type="checkbox" name="check_list[]" class="check"  value="'. $rows['id'].'">
    <span style="color:#800000">'.$rows['name'].'</span><br>

    <input type="text" name="text" size="5" readonly style="color:#808000" value="' .$rows['code'] . '"><br>
    <input type="text" name="text" size="5" readonly style="color:#00FF00" value="' .$rows['quantity']. '"><br>
    <input type="text" name="text" size="5" readonly style="color:#008000" value="' .$rows['price']  . ' " >

 </td>';
            }

    }
?>

