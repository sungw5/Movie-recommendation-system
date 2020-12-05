<?php
  require '../homepage/config.php';
  include('../registration/registration.php');
?>

<?php
if (is_admin() == false) {
  $_SESSION['msg'] = "You must log in first";
  header('location: ../login.php');
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
            <a class="nav-link" href="#">Movies<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="users.php">Users<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="review_request.php">Review-Requests <span class="sr-only">(current)</span></a>
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
      <h1 class="display-4">Welcome, 

        <?php  if (isset($_SESSION['user'])) : ?>
        <strong><?php echo $_SESSION['user']['username']; ?></strong>
        <small>
          <i  style="color: #888;">(logged in as <?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
        </small>
        <?php endif ?>

      </h1>
    </div>
    <div class="container">
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
                      </tr>
                      <tbody>
                      <?php
                        $results = $con -> query("SELECT M.movie_id, M.movie_name, M.running_time, M.us_distributor, M.mpaa, 
                        B.rank, B.lifetime_gross 
                        FROM movie_summary M, bo_summary B
                        WHERE M.movie_id = B.movie_id
                        LIMIT 30");
                        while ($row = mysqli_fetch_array($results)) {?>
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
                                                  $new_results = $con -> query("SELECT C.member_name, C.role
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
                                  <svg width="2em" height="1.5em" viewBox="0 0 20 20" class="bi bi-heart-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                  </svg>
                                </button>
                              </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </thead>
              </table>
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
