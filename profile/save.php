 <?php
		 ini_set('display_errors', 1);
         ini_set('display_startup_errors', 1);
         error_reporting(E_ALL);
         $username = 'root';
         $password = '';
         $host = 'localhost';
         $dbname = 'cmpsc431';	
?>
<!DOCTYPE html>
<html>  
			
			<?php 
				echo "Change information: <br>"; 
				echo "Userid:   ". $_POST["userid"]."<br>";
				echo "Name:   ". $_POST["name"]."<br>";
				echo "Email:  ". $_POST["email"]."<br>";	
				echo "Phone:  ". $_POST["phone"]."<br>";
				
				$sql='Update users set name = "';
				$sql= $sql . $_POST["name"]. '", email= "'.$_POST["email"].'", phone="'.$_POST["phone"].'" where userid = "'.$_POST["userid"].'"' ;
			
				
				
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					
					
					
					$file = $_FILES["photo"];	
					$typeArr = explode("/", $file["type"]);
					$imgType = array("png","jpg","jpeg");
					if($typeArr[0]== "image"){
						if(in_array($typeArr[1], $imgType)){	
							 $path = "photo/".$_POST["userid"].".".$typeArr[1];
							move_uploaded_file($file["tmp_name"], $path);

							$sql_photo='Update users set photo_path = "';
							$sql_photo= $sql_photo . $path. '"' ;
							$conn->exec($sql_photo);
						}
					}
				}
				
				 catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			
					echo "Successfully";
			?>
				<p>You will be redirected in 3 seconds</p>
				<script>
					var timer = setTimeout(function() {
						window.location='profile.php'
					}, 3000);
				</script>
			
		

</html>
