<?php



     $link = mysqli_connect('localhost','root','mysql','production');
 

if(isset($_GET["term"])){
    
    $term = $_REQUEST['term'];    

    $sql = "SELECT * FROM product WHERE title LIKE '%".$term."%'";
    
    $r_query = mysqli_query($link,$sql);

while ($row = mysqli_fetch_array($r_query)){ 
  echo "<div >";
         echo "<p id='ptag'>" . $row["title"] ."</p>";
         echo " <input type='hidden' name='product[]' id='my' value='".$row["id"]."' >";
                echo "</div>";
} 
    
    
}
 
mysqli_close($link);
?>