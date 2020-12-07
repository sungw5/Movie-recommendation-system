 <?php
	require "../homepage/config.php";
	$user = $_SESSION['user']['username'];
	$username = 'root';
	$password = '';
	$host = 'localhost';
	$dbname = 'users';
?>

<!DOCTYPE html>
<html>  

	<?php 
		$userid = $_POST["user_id"];
		$name = $_POST["name"];
		$email = $_POST["email"];	
		$phone = $_POST["phone"];
		
		$sql = "UPDATE user_registration SET name='$name', email='$email', phone='$phone'  
						WHERE username = '$user'";
	
		try {
			$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
		
			$file = $_FILES["photo"];	
			$typeArr = explode("/", $file["type"]);
			$imgType = array("png","jpg","jpeg");
			if($typeArr[0]== "image"){
				if(in_array($typeArr[1], $imgType)){	
						$path = "photo/".$_POST["user_id"].".".$typeArr[1];
					move_uploaded_file($file["tmp_name"], $path);

					$sql_photo="UPDATE user_registration SET photo_path = '' WHERE username = '$user'";
					$sql_photo= $sql_photo . $path. '"' ;
					$conn->exec($sql_photo);
				}
			}
		}
		catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
		}
		$conn = null;
		echo "Update succesfull!";
		header("refresh:3; url=http://localhost/cmpsc431w-movie-recommendation-system/profile/profile.php");
	?>
</html>
