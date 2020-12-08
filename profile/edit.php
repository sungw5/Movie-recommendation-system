
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
            <a class="nav-link" href="../homepage/homepage.php">Home <span class="sr-only">(current)</span></a>
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
                                        ini_set('display_errors', 1);
                                        ini_set('display_startup_errors', 1);
                                        error_reporting(E_ALL);
                                        $mysql_username = 'root';
                                        $mysql_password = '';
                                        $host = 'localhost';
                                        $dbname = 'users';
                                    try {
                                        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $mysql_username, $mysql_password);
                                        $username =  $_GET['username'];
                                        $sql ='SELECT username,password,email,phone,photo_path FROM user_registration Where username = "'.$username.'"';
                                        $q = $pdo->query($sql);
                                        $q->setFetchMode(PDO::FETCH_ASSOC);
                                    } 
                                    catch (PDOException $e) {
                                    die("Could not connect to the database $dbname :" . $e->getMessage());
                                    }
                                    $row = $q->fetch();
                                    $password = $row['password'];
                                    $email = $row['email'];
                                    $phone = $row['phone'];
                                    $photo_path = $row['photo_path'];
                                   
                                    
                                    ?>
                                       
                                        <img id="pic" height="200" width="200" src = "<?php echo htmlspecialchars($photo_path) ?>"/>
                                        <form action="./save.php" method = "post" enctype="multipart/form-data">
                           
                                        <input type="file" name="photo" class="text-center center-block file-upload">
                                        
                                        <br>
                                        <br>
                                        User ID:<br>
                                        <?php echo htmlspecialchars($username) ?>
                                       <input type="hidden" name="username" value="<?php echo htmlspecialchars($username) ?>">
                                        <br><br>
                                        Password:<br>                                      
                                        <input type="text" name="password" value="<?php echo htmlspecialchars($password) ?>">
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
    
    <script type="text/javascript">
      $(document).ready(function () {
        $("#id-table").DataTable();
      });
    </script>
  </body>
</html>



