<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "users");
if(!$con) {
  echo "Could not connect";
}
mysqli_select_db($con, "users");

$username = $_POST["user"];
$password = $_POST["pwd"];

$query = "SELECT * FROM user_registration WHERE username = '$username' && password = '$password'";
$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);

if($count == 1) {
  header("location:../homepage/homepage.php");
} else {
  header("location:../login/login.html");
}
?>