<?php
  require '../homepage/config.php';
  include('../registration/registration.php');
?>

<?php
if (is_logged_in() == false) {
  header('location:../login/login.html');
}

$user = $_SESSION['user']['username'];
?>

<!DOCTYPE html>
<html>  
	<?php 
		$sql='UPDATE user_registration SET password = "';
		$sql= $sql . $_POST["password"]. '", name= "'.$_POST["name"].'", email= "'.$_POST["email"].'", 
					phone="'.$_POST["phone"].'" 
					WHERE username = "'.$user.'"' ;

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$db", $mysql_username, $mysql_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);

			$file = $_FILES["photo"];	
			$typeArr = explode("/", $file["type"]);
			$imgType = array("png","jpg","jpeg");
			if($typeArr[0]== "image"){
				if(in_array($typeArr[1], $imgType)){	
					$path = "photo/".$user.".".$typeArr[1];
					$exist = "photo/".$user.".".$typeArr[1];
					if(file_exists($exist)){
						unlink($exist);
					}
					move_uploaded_file($file["tmp_name"], $path);
					$sql_photo='UPDATE user_registration SET photo_path = "';
					$sql_photo= $sql_photo . $path.'" where username = "'.$user.'"' ; 
					$conn->exec($sql_photo);
				}
			}
			header("refresh:3; url= http://cmpsc431-s3-g-14.vmhost.psu.edu/profile/profile.php");
			header("location: profile.php");
		}
		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		?>
</html>