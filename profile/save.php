<?php
  require "../homepage/config.php";
	$user = $_SESSION['user']['username'];
?>

<!DOCTYPE html>
<html>  

	<?php 
	if(isset($_POST['submit'])) {
		$name = $_POST["name"];
		$email = $_POST["email"];	
    $phone = $_POST["phone"];
    $pwd = $_POST["password"];

    $sql = "UPDATE user_registration SET name='$name', email='$email', phone='$phone', password='$pwd'
    WHERE username = '$user'";
    mysqli_query($con, $sql);
		}
		header("location: ../profile/profile.php");
	?>
</html>