<?php
    require '../homepage/config.php';
    session_start(); 


    // Delete
    if(isset($_GET['delete'])){

        $id = $_GET['delete'];

        $con->query("DELETE FROM movie_recommendation_db WHERE id=$id") or die($con->error());

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("location: review_request.php");

    }






?>