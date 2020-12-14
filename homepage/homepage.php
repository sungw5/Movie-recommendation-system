<?php
  require 'config.php';
  include('../registration/registration.php');
?>

<?php
if (is_logged_in() == false) {
  header('location:../login/login.html');
}

$username = $_SESSION['user']['username'];

if(isset($_POST['movie_name'])) {
      $movie_name = $_POST['movie_name'];
      $movie_id = $_POST['movie_id'];

      $fav_query = "INSERT INTO user_favorites (username, movie_id, movie_name) VALUES('$username', '$movie_id', '$movie_name')";
      mysqli_query($con, $fav_query);

      $_SESSION['success'] = "Movie registration successful";
      header("location:../admin/users.php");
    }

    if(isset($_POST['remove_movie_id'])) {
      $remove_movie_id = $_POST['remove_movie_id'];
      $query = "DELETE FROM user_favorites WHERE movie_id='".$remove_movie_id."' AND username='".$username."'";
      mysqli_query($con, $query);
      header("location:../admin/users.php");
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  
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
            <a class="nav-link" href="../homepage/favorites.php">Favorites <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../custom_list/custom-lists.php">My Lists <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="request.php">Request <span class="sr-only">(current)</span></a>
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
      <h1 class="display-4">Welcome, 
        <?php  if ($_SESSION['user']['user_type'] === "admin") {
          header("location:../admin/adminhomepage.php");
        }
        ?>
        <?php  if (isset($_SESSION['user'])) : ?>
        <?php echo $_SESSION['user']['username']; ?>
        <div class="text-left">
          <p class="h4">
            <i  style="color: #888;">(logged in as <?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
          <?php endif ?>
          </p>
        </div>
      </h1>
    </div>
    <div class="container">
        <div class="row justify-content-md-center">
          <h2>Top 300 Movies <i class="fas fa-film"></i></h2>
        </div>
        <div class="row">
          <div class="col">
              <table class="table table-striped" id="id-table">
                  <thead class="thead-dark">
                      <tr>
                          <th>Rank</th>
                          <th>Movie</th>
                          <th>US Distributor</th>
                          <th>Duration</th>
                          <th>Lifetime Gross</th>
                          <th>MPAA</th>
                          <th>Crew</th>
                          <th>Box Office Data</th>
                          <th>Favorite</th>
                          <th>Add To</th>
                      </tr>
                      <tbody>
                      <?php
                        $results = $con -> query("SELECT M.movie_id, M.movie_name, M.running_time, M.us_distributor, M.mpaa, 
                        B.rank, B.lifetime_gross 
                        FROM movie_summary M, bo_summary B
                        WHERE M.movie_id = B.movie_id LIMIT 300");
                        while ($row = mysqli_fetch_array($results)) {
                          $id = $row['movie_id'];
                          $movie_name = $row['movie_name'];
                          $us_distributor = $row['us_distributor'];
                          $running_time = $row['running_time'];
                          $lifetime_gross = $row['lifetime_gross'];
                          $mpaa = $row['mpaa'];
                          ?>
                          <tr>
                              <td><?php echo $row["rank"]; ?></td>
                              <td><?php echo $row["movie_name"]; ?></td>
                              <td><?php echo $row["us_distributor"]; ?></td>
                              <td><?php echo $row["running_time"]; ?></td>
                              <td><?php echo $row["lifetime_gross"]; ?></td>
                              <td><?php echo $row["mpaa"]; ?></td>
                              <td>      
                                <?php $movie_id = $row["movie_id"]; ?>    
                                <?php $movie_name = $row["movie_name"]; ?>
                                
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_<?php echo $movie_id?>">
                                  Crew 
                                </button>
                                <div class="modal fade" id="modal_<?php echo $movie_id?>" tabindex="-1" role="dialog" aria-labelledby="modal_<?php echo $id?>" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $movie_name; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <table class="table" id="id-table">
                                          <thead class="thead-dark">
                                              <tr>
                                                  <th>Name</th>
                                                  <th>Role</th>
                                              </tr>
                                              <tbody>
                                                <?php
                                                  $new_results = $con -> query("SELECT DISTINCT C.member_name, C.role
                                                  FROM movie_crew_data C
                                                  WHERE C.movie_id = '$movie_id'
                                                  ORDER BY C.member_name");
                                                
                                                  while ($row = mysqli_fetch_array($new_results)) {?>
                                                    <tr>
                                                        <td><?php echo $row["member_name"]; ?></td>
                                                        <td><?php echo $row["role"]; ?></td>
                                                    </tr>
                                                  <?php } ?>
                                              </tbody>
                                          </thead>
                                        </table>                                  
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>                
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#price_modal_<?php echo $movie_id?>">
                                  Collection 
                                </button>
                                <div class="modal fade" id="price_modal_<?php echo $movie_id?>" tabindex="-1" role="dialog" aria-labelledby="price_modal_<?php echo $movie_id?>" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $movie_name; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <table class="table" id="id-table">
                                          <thead class="thead-dark">
                                              <tr>
                                                  <th>Country</th>
                                                  <th>Release Date</th>
                                                  <th>Opening</th>
                                                  <th>Gross</th>
                                              </tr>
                                              <tbody>
                                                <?php
                                                  $bo_results = $con -> query("SELECT B.market, B.release_date, B.opening, B.gross
                                                  FROM bo_collections_data B, bo_releases_id R
                                                  WHERE R.movie_id = '$movie_id' AND
                                                  R.release_id = B.release_id
                                                  ORDER BY B.market, B.release_date");
                                                
                                                  while ($row = mysqli_fetch_array($bo_results)) {?>
                                                    <tr>
                                                        <td><?php echo $row["market"]; ?></td>
                                                        <td><?php echo $row["release_date"]; ?></td>
                                                        <td><?php echo $row["opening"]; ?></td>
                                                        <td><?php echo $row["gross"]; ?></td>
                                                    </tr>
                                                  <?php } ?>
                                              </tbody>
                                          </thead>
                                        </table>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <a type="button" class="btn btn-light" href="#">
                                  <?php
                                    $fav_results = $con->query("SELECT * FROM user_favorites WHERE username = '$username'");
                                    $favourite_movies = array();
                                    while ($fav_row = mysqli_fetch_array($fav_results)) { 
                                      if($fav_row['movie_id']==$movie_id){
                                        array_push($favourite_movies, $movie_id);
                                      }
                                    }
                                    if (in_array($movie_id, $favourite_movies)) {
                                        $color = "red";
                                    } else {
                                        $color = "grey";
                                    }
                                  ?>
                                  <svg width="2em" height="1.5em" viewBox="0 0 20 20" class="bi bi-heart-fill"      
                                    <?php if($color=="grey"){ ?> 
                                      onclick="addFavourites('<?php echo $movie_id; ?>','<?php echo $movie_name; ?>', '<?php echo $username ?>')" 
                              <?php } else { ?> 
                                      onclick="removeFavourites('<?php echo $movie_id; ?>', '<?php echo $username ?>')" 
                              <?php } ?>     
                                      fill="<?php echo $color; ?>" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                  </svg>
                                </a>
                              </td>

                            <!-- custom list -->
                            <td>
                              <form action="../custom_list/function.php" method="post">
                                <select class="form-select" aria-label="Default select example" name="selectOption" >
                                  <option value="Add To" disabled selected>Add To</option>
                                  <option value="Watched">Watched</option>
                                  <option value="Will Watch">Will Watch</option>
                                  <option value="Would Recommend">Would Recommend</option>
                                </select> 
                                <input type="hidden" name="selected_id" value="<?php echo $id; ?>">
                                <input type="hidden" name="selected_movie_name" value="<?php echo $movie_name; ?>">
                                <input type="hidden" name="selected_username" value="<?php echo $username; ?>">
                                <input type="submit" name="add" value="Add" class="btn btn-info btn-sm">
                              </form>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </thead>
              </table>
          </div>
        </div>

      <div style="padding: 50px" class="row justify-content-md-center">
        <a href="extra.php">More movies</a>
      </div>
    </div>

    

    <script defer type="text/javascript">
      $(document).ready(function () {
        $("#id-table").DataTable();
      });

      function addFavourites(movie_id, movie_name, username){
        var formData = {movie_name: movie_name, movie_id: movie_id, username: username};
        $.ajax({
            url : location.href,
            type: "POST",
            data : formData,
            success: function(response)
            {
              alert('Added to Favourites');
              location.reload();
            }
        });
      }
      function removeFavourites(remove_movie_id, username){
        var removeData = {remove_movie_id: remove_movie_id, username: username};
        $.ajax({
            url : location.href,
            type: "POST",
            data : removeData,
            success: function(response)
            {
              alert('Removed from Favourites');
              location.reload();
            }
            
        });
      }
    </script>
  </body>
</html>