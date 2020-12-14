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
        $year = $row['release_date'];
        try {
            $con->query("INSERT INTO movie_summary (movie_id, movie_name, mpaa, running_time) VALUES('$id', '$movie_name', '$mpaa', '$running_time');");
            $con->query("INSERT INTO bo_summary (movie_name, year, movie_id) VALUES('$movie_name', '$year', '$id');");
            $con->query("DELETE FROM movie_recommendation_db WHERE id=$id");
        } catch (mysqli_sql_exception $e) {
            die("Could not execute accept operation :" . $e->getMessage());
        }
        header("location: review_request.php");
        $con->commit();
    }
?>