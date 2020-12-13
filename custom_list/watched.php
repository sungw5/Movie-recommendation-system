<?php
  require '../homepage/config.php';
  include('../registration/registration.php');
?>

<?php
if (is_logged_in() == false) {
  header('location:../login/login.html');
}

$username = $_SESSION['user']['username'];
$custom_type = "Watched";
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
              <a class="nav-link" href="../homepage/homepage.php">Home <span class="sr-only">(current)</span></a>
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
      <h1 class="display-4">Watched</h1>
    </div>
  
    <div class="container">
      <div class="row justify-content-center align-items-center">
          <div class="col-lg-4 col-lg-offset-4">
           <a href="homepage.php" class="btn btn-dark" >Add More 
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
            </svg>
           </a> 
          </div>
      </div>
    </div> 

    <br /><br />
    <div class="row row-cols-4 row-cols-md-4">
      <?php
      $custom_results = $con-> query("SELECT movie_id, movie_name FROM custom_list WHERE username= '".$username."' AND custom_type= '".$custom_type."' ORDER BY movie_name");
      $count = mysqli_num_rows($custom_results);
      if($count == 0) {} 
      else {
        while ($custom_row = mysqli_fetch_array($custom_results)) { ?>
          <div class="col-mb-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?php echo $custom_row['movie_name']; ?></h5>
                <p class="card-text"></p>
              
                <?php $movie_id = $custom_row["movie_id"]; ?>    
                <?php $movie_name = $custom_row["movie_name"]; ?>
                
                <!-- Display crew information -->
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
  
                <!-- Display collection information -->
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
  
                <div class="modal fade" id="modal_<?php echo $movie_id?>" tabindex="-1" role="dialog" aria-labelledby="modal_<?php echo $movie_id?>" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content modal-lg">
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
                                  <th>Crew</th>
                                  <th>Market</th>
                                  <th>Release Date</th>
                                  <th>Opening</th>
                                  <th>Gross</th>
                              </tr>
                              <tbody>
                                <?php
                                  $new_results = $con -> query("SELECT M.running_time, 
                                  C.member_name,
                                  B.market, B.release_date, B.opening, B.gross, 
                                  S.rank,
                                  F.favorite_id
                                  FROM movie_summary M, bo_collections_data B, bo_releases_id R, bo_summary S, movie_crew_data C, user_favorites F
                                  WHERE M.movie_id = '$movie_id' AND
                                  R.release_id = B.release_id AND
                                  R.movie_id = M.movie_id AND
                                  C.movie_id = M.movie_id AND
                                  S.movie_id = M.movie_id AND
                                  F.movie_id = M.movie_id
                                  ORDER BY M.movie_name, B.release_date");
  
                                  while ($row = mysqli_fetch_array($new_results)) {?>
                                    <tr>
                                        <td><?php echo $row["member_name"]; ?></td>
                                        <td><?php echo $row["market"]; ?></td>
                                        <td><?php echo $row["release_date"]; ?></td>
                                        <td><?php echo $row["opening"]; ?></td>
                                        <td><?php echo $row["gross"]; ?></td>
                                    </tr>
                                    <?php $rank = $row["rank"]; ?>
                                    <?php $running_time = $row["running_time"]; ?>
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
              </div>
  
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Rank:</strong> <?php echo $rank ?></li>
                <li class="list-group-item"><strong>Running time:</strong> <?php echo $running_time ?></li>
              </ul>
  

            </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>