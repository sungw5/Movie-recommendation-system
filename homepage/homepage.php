<?php
  require 'config.php';
  require 'process.php';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="../favorites.html">Favorites <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Lists <span class="sr-only">(current)</span></a>
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
      <h1 class="display-4">Welcome</h1>
    </div>
    <div class="container">
        <div class="row">
          <div class="searchbar col-lg-4 col-lg-offset-4">
              <input type="search" id="search" value="" class="form-control" placeholder="Search movies">
          </div>
        </div><br/>
        <div class="row">
          <div class="col-lg-8 mr-4">
              <table class="table" id="table">
                  <thead class="thead-dark">
                      <tr>
                          <th class="th-sm">Movie ID</th>
                          <th>Movie Title</th>
                          <th>Duration</th>
                      </tr>
                      <tbody>
                      <?php
                        $result_per_page = 50;

                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $start_page = ($page - 1) * $result_per_page;

                        $results = $con -> query("SELECT movie_id, movie_name, running_time FROM movie_summary LIMIT $start_page, $result_per_page");
                        $total_results = $con -> query("SELECT movie_id, movie_name, running_time FROM movie_summary");

                        $number_of_results = mysqli_num_rows($results);
                        $total_num_of_results = mysqli_num_rows($total_results);
                        $number_of_pages = ceil($total_num_of_results / $result_per_page);

                        if($page - 1 >= 1) {
                          $previous = $page - 1;
                        } else {
                          $previous = 1;
                        }
                        
                        if($page + 1 <= $number_of_pages) {
                          $next = $page + 1;
                        } else {
                          $next = $number_of_pages;
                        }
                        while ($row = mysqli_fetch_array($results)) {?>
                          <tr>
                              <td><?php echo $row["movie_id"]; ?></td>
                              <td><?php echo $row["movie_name"]; ?></td>
                              <td><?php echo $row["running_time"]; ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                  </thead>
              </table>
              <hr>
              <nav aria-label="...">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a class="page-link" href="homepage.php?page=<?= $previous; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                  </li>

                  <?php for($i=1; $i<$number_of_pages; $i++): ?>
                    <li class="page-item"><a class = "page-link" href="homepage.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                  <?php endfor; ?>
    
                  <li class="page-item">
                    <a class="page-link" href="homepage.php?page=<?= $next; ?>"">Next</a>
                  </li>
                </ul>
              </nav>
          </div>
          <div class="col-lg-3 ml-5">
                <h3>Update Request</h3>
                <br />
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label for="req-movie">Movie Name</label>
                        <input type="text" name="movie_title" class="form-control" placeholder="Enter movie name">
                    </div>
                    <div class="form-group">
                        <label for="req-total-gross">Total Gross</label>
                        <input type="number" name="total_gross" class="form-control" placeholder="Enter total gross">
                    </div>
                    <div class="form-group">
                        <label for="req-duration">Duration</label>
                        <input type="text" name="running_time" class="form-control" placeholder="Enter duration">
                    </div>
                    <div class="form-group">
                        <label for="req-release">Release</label>
                        <input type="text" name="release_date" class="form-control" placeholder="Enter release year">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="update-req-btn btn btn-dark">Submit</button>
                    </div> 
                </form>
          </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>
