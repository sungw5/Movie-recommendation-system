<?php
  if(!isset($_SESSION)) { 
    session_start(); 
  } 
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $db = "431group";
  $servername = "CMPSC431-S3-G-14.vmhost.psu.edu";
  $mysql_username = "431group_db";
  $mysql_password = "password";

  try {
  $con = mysqli_connect($servername, $mysql_username, $mysql_password);
  mysqli_select_db($con, $db);
  } catch (mysqli_sql_exception $e) {
  die("Could not connect to the database $db :" . $e->getMessage());
  }
?>
