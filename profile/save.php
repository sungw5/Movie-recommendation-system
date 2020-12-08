 <?php
	 ini_set('display_errors', 1);
         ini_set('display_startup_errors', 1);
         error_reporting(E_ALL);
         $mysql_username = 'root';
         $mysql_password = '';
         $host = 'localhost';
         $dbname = 'cmpsc431';	
?>
<!DOCTYPE html>
<html>  
			
			<?php 
				echo "Change information: <br>"; 
				echo "User_id:   ". $_POST["username"]."<br>";
				echo "Password:   ". $_POST["password"]."<br>";
				echo "Email:  ". $_POST["email"]."<br>";	
				echo "Phone:  ". $_POST["phone"]."<br>";
				
				$sql='Update user_registration set password = "';
				$sql= $sql . $_POST["password"]. '", email= "'.$_POST["email"].'", phone="'.$_POST["phone"].'" where username = "'.$_POST["username"].'"' ;
			
				
				
				try {
					$conn = new PDO("mysql:host=$host;dbname=$dbname", $mysql_username, $mysql_password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					
					
					
					$file = $_FILES["photo"];	
					$typeArr = explode("/", $file["type"]);
					$imgType = array("png","jpg","jpeg");
					if($typeArr[0]== "image"){
						if(in_array($typeArr[1], $imgType)){	
							$path = "photo/".$_POST["username"].".".$typeArr[1];
							$exist = "photo/".$_POST["username"].".".$typeArr[1];
							if(file_exists($exist)){
								unlink($exist);
							}
							move_uploaded_file($file["tmp_name"], $path);
							$sql_photo='Update user_registration set photo_path = "';
							$sql_photo= $sql_photo . $path.'" where username = "'.$_POST["username"].'"' ; 
							$conn->exec($sql_photo);
						}
					}
				}
				
				 catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
				?>
				
				<form action="../homepage/homepage.php"  >
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($username) ?>">           
					<input type="submit" value="Successfully">
				</form> 
					
			
				
			
		

</html>
