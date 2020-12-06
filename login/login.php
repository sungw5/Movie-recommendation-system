<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "users");
if(!$con) {
  echo "Could not connect";
}
mysqli_select_db($con, "users");

$username = "";

if(isset($_POST['signin'])){
  login();
}

function login(){
  global $con, $username;

  $username = $_POST["user"];
  $password = $_POST["pwd"];

  $query = "SELECT * FROM user_registration WHERE username='$username' AND password='$password' LIMIT 1";
  $result = mysqli_query($con, $query);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    // check if user is admin or user
    $logged_in_user = mysqli_fetch_assoc($result);


    if ($logged_in_user['user_type'] == 'admin') {
      $_SESSION['user'] = $logged_in_user;
      $_SESSION['success']  = "You are now logged in";
      // go to admin homepage
      header("location:../admin/adminhomepage.php");
    }
    else{

      $_SESSION['user'] = $logged_in_user;
      $_SESSION['success']  = "You are now logged in";
      // go to user homepage
      header("location:../homepage/homepage.php");
    }
  }

  else{ // login fail
    header("location:../login/login.html");
  }
}



?>
