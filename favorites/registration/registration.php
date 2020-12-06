
<?php
session_start();

$con = mysqli_connect("localhost", "root", "");
if(!$con) echo "Could not connect";

mysqli_select_db($con, "users");


$username = "";

if(isset($_POST['register']) || isset($_POST['create'])){
  register();
}


function register(){
  global $con, $username;

  $username = $_POST["user"];
  $password = $_POST["pwd"];
  

  $query = "SELECT * FROM user_registration WHERE username = '$username'";
  $result = mysqli_query($con, $query);
  $count = mysqli_num_rows($result);


  if($count >= 1){
    echo "Username already exists";
  }
  else{

    // if user_type is specified (admin - create user)
    if(isset($_POST['user_type'])){
      $user_type = $_POST['user_type'];

      $register_query = "INSERT INTO user_registration (username, password, user_type) VALUES('$username', '$password', '$user_type')";
      mysqli_query($con, $register_query);

      $_SESSION['success'] = "User registration successful";
      // directs to admin's user management page
      header("location:../admin/users.php");
    }
    else{ // regular user registration

      $register_query = "INSERT INTO user_registration (username, password, user_type) VALUES('$username', '$password', 'user')";
      mysqli_query($con, $register_query);

      // to prevent access pages without login
      $logged_in_user_id = mysqli_insert_id($con);

      $id_query = "SELECT * FROM user_registration WHERE user_id=" . $logged_in_user_id;
      $id_query_result = mysqli_query($con, $id_query);
      $user = mysqli_fetch_assoc($id_query_result);

      $_SESSION['user'] = $user;
      $_SESSION['success'] = "User registration successful";
      header("location:../homepage/homepage.php");
    }
  }
}


function is_logged_in(){
  if(isset($_SESSION['user'])){
    return true;
  }
  else{
    return false;
  }
}

function is_admin(){
  if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
    return true;
  }else{
    return false;
  }
}



?>