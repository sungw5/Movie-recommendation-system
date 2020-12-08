<?php
require '../homepage/config.php';

$username = "";

if(isset($_POST['register']) || isset($_POST['create'])) {
  $search = "SELECT 1 FROM `user_registration` LIMIT 1";
  $is_table_exists = mysqli_query($con, $search);

  if($is_table_exists == TRUE) {}
  else {
    $SQL = "CREATE TABLE user_registration (
        user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        phone INT(12) NOT NULL,
        username VARCHAR(25) NOT NULL, 
        password VARCHAR(50) NOT NULL, 
        user_type VARCHAR(25) NOT NULL, 
        timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";

    if(mysqli_query($con, $SQL)) {
        echo "Table created successfully";
    } else {
        echo "ERROR: Could not execute $SQL. " . mysqli_error($con);
    }
  }
  register();
}

function register() {
  global $con, $username;

  $username = $_POST["user"];
  $password = $_POST["pwd"];
  
  $query = "SELECT * FROM user_registration WHERE username = '$username'";
  $result = mysqli_query($con, $query);
  $count = mysqli_num_rows($result);

  if($count >= 1) {
    echo "Username already exists";
    header("refresh:3; url=http://cmpsc431-s3-g-14.vmhost.psu.edu/login/login.html");
  }
  else {
    if(isset($_POST['user_type'])) {
      $user_type = $_POST['user_type'];

      $register_query = "INSERT INTO user_registration (username, password, user_type) VALUES('$username', '$password', '$user_type')";
      mysqli_query($con, $register_query);

      $_SESSION['success'] = "User registration successful";
      header("location:../admin/users.php");
    }
    else { 
      $register_query = "INSERT INTO user_registration (username, password, user_type) VALUES('$username', '$password', 'user')";
      mysqli_query($con, $register_query);
      $logged_in_user_id = mysqli_insert_id($con);

      $id_query = "SELECT * FROM user_registration WHERE user_id=" . $logged_in_user_id;
      $id_query_result = mysqli_query($con, $id_query);
      $user = mysqli_fetch_assoc($id_query_result);

      $_SESSION['user'] = $user;
      $_SESSION['success'] = "User registration successful";
      header("location:../login/login.html");
    }
  }
}

function is_logged_in() {
  if(isset($_SESSION['user'])) {
    return true;
  }
  else {
    return false;
  }
}

function is_admin() {
  if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
    return true;
  } else {
    return false;
  }
}
?>