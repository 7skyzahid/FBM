<?php
session_start();

// initializing variables
$type = "";
$email    = "";
$errors = array(); 
$date=date("Y-m-d");
// connect to the database
$db = mysqli_connect('localhost','root','mysql','clinic');

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $type = mysqli_real_escape_string($db, $_POST['type']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($type)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($password_2)) { array_push($errors, "Conform Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE type='$type' OR email='$email'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO users (type, email, password,created_at) 
          VALUES('$type', '$email', '$password','$date')";
    mysqli_query($db, $query);
    // $_SESSION['username'] = $username;
    // $_SESSION['success'] = "You are now logged in";
    // header('location: login.php');
  }
}
 
   
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

  if (count($errors) == 0) {

    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($connection, $query);
   if (mysqli_num_rows($results) == 1) {
    while ($row=mysqli_fetch_array($results)) {
        $type=$row['type'];
        $_SESSION['username'] = $type;
      $_SESSION['success'] = "Logged In";
      header('location: index.php');
    }
   }else {
      array_push($errors, "Wrong Email/Password Combination");
    }
  }
}

?>