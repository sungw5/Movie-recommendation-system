<?php
require '../homepage/config.php';

$username = "";

if(isset($_POST['signin'])) {
  login();
}

function login() {
  global $con, $username;

  $username = $_POST["user"];
  $password = $_POST["pwd"];

  $query = "SELECT * FROM user_registration WHERE username='$username' AND password='$password' LIMIT 1";
  $result = mysqli_query($con, $query);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    $logged_in_user = mysqli_fetch_assoc($result);

    if ($logged_in_user['user_type'] == 'admin') {
      $_SESSION['user'] = $logged_in_user;
      $_SESSION['success']  = "You are now logged in";
      header("location:../admin/adminhomepage.php");

    } else {
      $_SESSION['user'] = $logged_in_user;
      $_SESSION['success']  = "You are now logged in";
      header("location:../profile/profile.php");
    }

  } else if ($count == 0) {
    echo "Invalid username or password";
    header("refresh:3; url=http://localhost/cmpsc431w-movie-recommendation-system/login/login.html");
  }
}
?>
