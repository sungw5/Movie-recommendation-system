<?php
  require 'config.php';
  require 'process.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../homepage/homepage.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Favorites <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Lists <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="request.php">Request <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle mr-5" fill="white" xmlns="http://www.w3.org/2000/svg">
          <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
          <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
          <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
        </svg>
        <form class="form-inline my-2 my-lg-0">
          <a class="btn btn-danger my-2 my-sm-0" href="login/login.html" role="button">Logout</a>
        </form>
      </div>
    </nav>
    <div class="jumbotron">
      <h1 class="display-4">Favorites</h1>
    </div>

    <!-- <div class="container">
      <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
              <input type="search" id="search" value="" class="form-control" placeholder="Search movies">
          </div>
      </div>
    </div> -->

    <div class="container">
      <div class="row">
          <div class="col-lg-4 col-lg-offset-4">
           <a href="homepage.php" class="btn btn-warning" >Add More 
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
            </svg>
           </a> 
          </div>
      </div>
    </div> 

    <br /><br />
    <div class="row">
      <div class="col-sm-6">
        <div class="card-deck">
          <?php
          $fav_results = $con->query("SELECT movie_name FROM user_favorites");
          
          while ($fav_row = mysqli_fetch_array($fav_results)) { ?>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $fav_row['movie_name']; ?></h5>
                <p class="card-text"></p>
              </div>
              <div class="card-footer">
                <i class="fa fa-heart" style="color:red" aria-hidden="true"></i>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>