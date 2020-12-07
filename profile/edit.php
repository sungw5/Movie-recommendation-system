<?php
  require "../homepage/config.php";
  $user = $_SESSION['user']['username'];
	$username = 'root';
	$password = '';
	$host = 'localhost';
	$dbname = 'users';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
  
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../homepage/favorites.html">Favorites <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Lists <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="request.php">Update <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle mr-5" fill="white" xmlns="http://www.w3.org/2000/svg">
          <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
          <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
          <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
        </svg>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-danger my-2 my-sm-0" href="../logout.php" role="button">Logout</a>
        </form>
      </div>
    </nav>
    <div class="jumbotron">
      <h1 class="display-4">Edit</h1>
    </div>
    
    <div class="container">
        <div class="row">
          <div class="col-lg-8 mr-4">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php
                  try {
                      $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                      $sql = "SELECT user_id, name, email, phone, photo_path FROM user_registration WHERE username='$user'";
                      $q = $pdo->query($sql);
                      $q->setFetchMode(PDO::FETCH_ASSOC);
                  } 
                  catch (PDOException $e) {
                  die("Could not connect to the database $dbname :" . $e->getMessage());
                  }
                  $row = $q->fetch();
                  $userid = $row['user_id']; 
                  $name = $row['name'];
                  $email = $row['email'];
                  $phone = $row['phone'];
                  $photo_path = $row['photo_path'];
                  ?>
                      
                  <img id="pic" height="200" width="200" src = "<?php echo htmlspecialchars($photo_path) ?>"/>
                  <form action="/cmpsc431w-movie-recommendation-system/profile/save.php" method = "post" enctype="multipart/form-data">
                    <input type="file" name="photo" class="text-center center-block file-upload">
                    <br>
                    <br>
                    User ID:<br>
                    <?php echo htmlspecialchars($userid) ?>
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userid) ?>">
                    <br><br>
                    Name:<br>                                      
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
                    <br><br>                                       
                    Email:<br>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
                    <br><br>
                    Phone:<br>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone) ?>"> 
                    <br><br>
                    <input type="submit" value="Save">
                  </form> 
               </div>   
          </div>
        </div>
    </div>
  </body>
</html>
