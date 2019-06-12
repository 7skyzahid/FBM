<?php
include 'includes/db.php';
if(isset($_POST['id']))
 {
  $id= $_POST['id'];

  $query=mysqli_query($connection,"DELETE FROM users WHERE id='$id' ");

   

   }
   ?>