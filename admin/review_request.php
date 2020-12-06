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
            <a class="nav-link" href="adminhomepage.php">Movies<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="users.php">Users<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Review-Requests <span class="sr-only">(current)</span></a>
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

    <!-- Greetings -->
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


    <?php
      $result = $con->query("SELECT * FROM movie_recommendation_db");
    ?>
    
    <div class="container">
        <h3 class="d-flex justify-content-center">Movie Requests</h3>

        <div class="row">
          <div class="col">
              <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Movie name</th>
                        <th>MPAA</th>
                        <th>Running Time</th>
                        <th>Release Date</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                  

                <!-- Loop to print data in a table -->
                <?php while($row = $result->fetch_assoc()): ?>

                  <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['movie_name'] ?></td>
                    <td><?php echo $row['mpaa'] ?></td>
                    <td><?php echo $row['running_time'] ?></td>
                    <td><?php echo $row['release_date'] ?></td>

                    <!-- <td><button type="submit" name="accept" class="btn btn-sm btn-success">Accept</button></td> -->
                    <td><a href="review_request_function.php?accept=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Accept</a></td>
                    <td><a href="review_request_function.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a></td>

                  </tr>

                <?php endwhile ?>
              </table>
            </div>
        </div>

    </div>
    

    <script>
        // $(document).ready( function () {
        //     $('#myTable').DataTable();
        // } );
    </script>
  </body>
</html>
