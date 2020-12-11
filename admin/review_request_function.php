<?php
    require '../homepage/config.php';

    $con->begin_transaction();

    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = $con->query("DELETE FROM movie_recommendation_db WHERE id=$id") or die($con->error());

        if($query == TRUE){
            $_SESSION['message'] = "Record has been deleted!";
            $_SESSION['msg_type'] = "danger";

            $con->commit();
            header("location: review_request.php");
        } else {
            $con->rollback();
            echo "Error deleting the request: " . $con->error;
        }
    }

    if(isset($_GET['accept'])) {
        $id = $_GET['accept'];
        $result = $con->query("SELECT * FROM movie_recommendation_db WHERE id=$id") or die($con->error());
        $row = $result->fetch_array();

        $movie_name = $row['movie_name'];
        $mpaa = $row['mpaa'];
        $running_time = $row['running_time'];
        $release_date = $row['release_date'];


        $is_data_exists = $con->query("SELECT * FROM movie_summary WHERE movie_id='$id' LIMIT 1") or die($con->error());
        $count = mysqli_num_rows($is_data_exists);
        
        if($count == 1){
            echo "Requesting movie data already exists in movie_summary";
        }
        else{
            $insert = $con->query("INSERT INTO movie_summary (movie_id, movie_name, mpaa, running_time) VALUES('$id', '$movie_name', '$mpaa', '$running_time');") or die($con->error());
            $insert2 = $con->query("INSERT INTO bo_collections_data (movie_name, release_date) VALUES('$movie_name', '$release_date');") or die($con->error());
            $con->query("DELETE FROM movie_recommendation_db WHERE id=$id") or die($con->error());
        }


        header("location: review_request.php");
        $con->commit();
    }
?>