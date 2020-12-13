<?php
  require '../homepage/config.php';
  include('../registration/registration.php');
?>

<?php
if (is_admin() == false) {
  $_SESSION['msg'] = "You must log in first";
  header('location: ../login/login.html');
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
            <a class="nav-link" href="adminhomepage.php">Movies<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="users.php">Users<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="review_request.php">Review Requests <span class="sr-only">(current)</span></a>
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
        <?php  if ($_SESSION['user']['user_type'] !== "admin") {
          header("location:../homepage/homepage.php");
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
          <h2>Top 300-600 Movies <i class="fas fa-film"></i></h2>
        </div>
        <div class="row">
          <div class="col">
              <table class="table table-bordered table-striped" id="id-table">
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
                          <th>Action</th>
                      </tr>
                      <tbody>
                      <?php
                        $results = $con -> query("SELECT M.movie_id, M.movie_name, M.running_time, M.us_distributor, M.mpaa, 
                        B.rank, B.lifetime_gross 
                        FROM movie_summary M, bo_summary B
                        WHERE M.movie_id = B.movie_id LIMIT 300,300");
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
                                <!-- action -->
                                <a href="#edit<?php echo $id;?>" data-toggle="modal">
                                    <button type='button' class='btn btn-info btn-sm'><span class='fa fa-edit' aria-hidden='true'></span></button>
                                </a>
                                <br /><br />
                                <a href="#delete<?php echo $id;?>" data-toggle="modal">
                                    <button type='button' class='btn btn-danger btn-sm'><span class='fa fa-trash' aria-hidden='true'></span></button>
                                </a>
                              </td>


                              <!--Edit Item Modal -->
                              <div id="edit<?php echo $id; ?>" class="modal fade" role="dialog" tabindex="-1" role="dialog" aria-labelledby="edit<?php echo $id; ?>" aria-hidden="true">
                                  <form action="adminhomepage_function.php" method="post" class="form-horizontal" role="form">
                                      <div class="modal-dialog modal-lg">
                                          <!-- Modal content-->
                                          <div class="modal-content" >
                                              <div class="modal-header">
                                                <h4 class="modal-title">Edit Item</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                              <!-- body -->
                                              <div class="modal-body">
                                                  <input type="hidden" name="edit_item_id" value="<?php echo $id; ?>">
                                                  
                                                  <div class="form-group">
                                                      <!-- movie name -->
                                                      <label class="control-label col-sm-2 font-weight-bold" for="movie_name">Movie name</label>
                                                      <div class="col-sm-4">
                                                          <input type="text" class="form-control" id="movie_name" name="movie_name" value="<?php echo $movie_name; ?>" placeholder="Movie name" required autofocus> </div>
                                                      <!-- US distributor -->
                                                      <br />
                                                      <label class="control-label col-sm-2 font-weight-bold" for="us_distributor">Distributor</label>
                                                      <div class="col-sm-4">
                                                          <input type="text" class="form-control" id="us_distributor" name="us_distributor" value="<?php echo $us_distributor; ?>" placeholder="Distributor" required> </div>
                                                  </div>

                                                <div class="form-group">
                                                    <!-- Running time -->
                                                    <label class="control-label col-sm-2 font-weight-bold" for="running_time">Duration</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="running_time" name="running_time" value="<?php echo $running_time; ?>" placeholder="Running time" required autofocus> </div>
                                                    <!-- Lifetime gross -->
                                                    <br />
                                                    <label class="control-label col-sm-2 font-weight-bold" for="lifetime_gross">Gross</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="lifetime_gross" name="lifetime_gross" value="<?php echo $lifetime_gross; ?>" placeholder="Lifetime gross" required> </div>
                                                    <!-- MPAA -->
                                                    <br />
                                                    <label class="control-label col-sm-2 font-weight-bold" for="mpaa">MPAA</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" id="mpaa" name="mpaa" value="<?php echo $mpaa; ?>" placeholder="MPAA" required> </div>
                                                </div>

                                                  
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="submit" class="btn btn-info" name="update_item2"><span class="fa fa-edit"></span> Save changes</button>
                                                  <button type="button" class="btn btn-warning" data-dismiss="modal"><span class="fa fa-remove-circle"></span> Cancel</button>
                                              </div>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                  
                              <!--Delete Modal -->
                              <div id="delete<?php echo $id; ?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                      <form action="adminhomepage_function.php" method="post">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h4 class="modal-title">Delete</h4>
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                              <div class="modal-body">
                                                  <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                                                  <div class="alert alert-danger">Are you sure you want delete <strong>
                                                          <?php echo $movie_name; ?>?</strong> </div>
                                                  <div class="modal-footer">
                                                      <button type="submit" name="delete2" class="btn btn-danger"><span class="fa fa-trash"></span> YES</button>
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-remove-circle"></span> NO</button>
                                                  </div>
                                              </div>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </tr>

                          
                        <?php } ?>
                      </tbody>
                  </thead>
              </table>
          </div>
        </div>
        <div style="padding: 50px" class="row justify-content-md-center">
            <div class="col-md-4">
                <a href="adminhomepage.php">Back to top 300 movies</a>
            </div>
            <div class="col-md-4 offset-md-4">
                <a href="adminextra2.php">See more top 600~1000 movies </a>
            </div>
            
        </div>
    </div>

    <script defer type="text/javascript">
      $(document).ready(function () {
        $("#id-table").DataTable();
      });
    </script>
  </body>
</html>

