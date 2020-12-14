<?php

    require '../homepage/config.php';

    if(isset($_POST['selectOption'])){

        $selected_id = $_POST['selected_id'];
        $selected_movie_name = $_POST['selected_movie_name'];
        $selected_username = $_POST['selected_username'];
        $custom_type = $_POST['selectOption'];
        
        $message = "You have selected an option";
        echo "<script type='text/javascript'>alert('$message');</script>";

        $con->query("INSERT INTO custom_list (username, movie_id, movie_name, custom_type)
        VALUES('$selected_username', '$selected_id', '$selected_movie_name', '$custom_type');");

        header("location: ../homepage/homepage.php");
        
    }
    else{
        echo "ERROR: Could not add to custom list " . mysqli_error($con);
    }
  ?>