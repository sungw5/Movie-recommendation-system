<?php
  if(!isset($_SESSION)) { 
    session_start(); 
  } 
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $dbname = "users";

  try {
  $con = mysqli_connect("localhost", "root", "");
  mysqli_select_db($con, "users");
  } catch (mysqli_sql_exception $e) {
  die("Could not connect to the database $dbname :" . $e->getMessage());
  }
?>
