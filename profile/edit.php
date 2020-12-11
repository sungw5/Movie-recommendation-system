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
            <a class="nav-link" href="../homepage/favorites.php">Favorites <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Lists <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../homepage/request.php">Update <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <a class="nav-link" href="../profile/profile.php">
          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle mr-5" fill="white" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
          </svg>
        </a>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-danger my-2 my-sm-0" href="../logout.php" role="button">Logout</a>
        </form>
      </div>
    </nav>
    <div class="jumbotron">
      <h1 class="display-4">Edit</h1>
    </div>
    <div class="row justify-content-center align-items-center">
      <div class="col-10 col-md-8 col-lg-6">
        <?php
          try {
            $pdo = new PDO("mysql:host=$servername;dbname=$db", $mysql_username, $mysql_password);
            $sql = 'SELECT username, password, name, email, phone, photo_path FROM user_registration WHERE username = "'.$user.'"';
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
          $name = $row['name'];
        ?>

        <div class="row justify-content-center align-items-center">
          <img id="pic" height="250" width="250" src = "<?php echo htmlspecialchars($photo_path) ?>"/><br />
        </div>
        <br />
        <form action="save.php" method="POST" enctype="multipart/form-data">
          <div class="row justify-content-center align-items-center">
            <input type="file" name="photo" class="text-center center-block file-upload"><br /><br />
          </div>
          <div class="form-group">
              <label for="req-mpaa">Username</label>
              <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user) ?>" disabled="disabled"/>
          </div>
          <div class="form-group">
              <label for="req-mpaa">Name</label>
              <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name) ?>" />
          </div>
          <div class="form-group">
              <label for="req-duration">Email</label>
              <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($email) ?>" />
          </div>
          <div class="form-group">
              <label for="req-release">Phone</label>
              <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone) ?>" />
          </div>
          <div class="form-group">
              <label for="req-release">Password</label>
              <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($password) ?>" />
          </div>
          <div class="form-group row justify-content-center align-items-center">
              <button type="submit" name="submit" class="update-req-btn btn btn-dark">Save Changes</button>
          </div> 
        </form>  
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
        $("#id-table").DataTable();
      });
    </script>
  </body>
</html>