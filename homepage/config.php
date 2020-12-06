<?php
  $con = mysqli_connect("localhost", "root", "", "users");
  if(!$con) {
    die("Could not connect to database".$con->connect_error);
  }
?>