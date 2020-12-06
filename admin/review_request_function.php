<?php
    require '../homepage/config.php';
    session_start(); 

    // Start transaction
    $con->begin_transaction();

    // Delete
    if(isset($_GET['delete'])){


        $id = $_GET['delete'];

        $query = $con->query("DELETE FROM movie_recommendation_db WHERE id=$id") or die($con->error());

        if($query == TRUE){
            $_SESSION['message'] = "Record has been deleted!";
            $_SESSION['msg_type'] = "danger";

            $con->commit();
            header("location: review_request.php");
        }
        else{
            $con->rollback();
            echo "Error deleting the request: " . $con->error;
        }

    }

    // Accept - insert requested data into the movie table
    // Not completed
    if(isset($_GET['accept'])){

        $id = $_GET['accept'];

        $result = $con->query("SELECT * FROM movie_recommendation_db WHERE id=$id") or die($con->error());
        
        

        if(count(array($result))==1){
            $row = $result->fetch_array();
            $movie_name = $row['movie_name'];
            $mpaa = $row['mpaa'];
            $running_time = $row['running_time'];
            // $release_date = $row['release_date'];
        }

        $con->query("INSERT INTO movie_summary (movie_id, movie_name, mpaa, running_time) VALUES('$id', '$movie_name', '$mpaa', '$running_time');");
        $con->query("DELETE FROM movie_recommendation_db WHERE id=$id") or die($con->error());

        header("location: review_request.php");
        $con->commit();


    }






?>