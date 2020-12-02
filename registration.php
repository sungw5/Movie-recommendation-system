<?php
session_start();
header("location:login.html");

$con = mysqli_connect("localhost", "root", "");
if(!$con) {
  echo "Could not connect";
}
mysqli_select_db($con, "users");

$username = $_POST["user"];
$password = $_POST["pwd"];

$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);

if($count == 1) {
  echo "Username already exists";
} else {
  $register = "INSERT INTO users(username, password) VALUES ('$username', '$password')";
  mysqli_query($con, $register);
  echo "Registration successful";
}
?>