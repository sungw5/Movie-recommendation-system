<?php
require '../homepage/config.php';
include('../registration/registration.php');

if (is_logged_in() == false) {
    echo "Invalid username or password";
    header('location:../login/login.html');
}

if(isset($_POST['selectOption'])) {
    $selected_id = $_POST['selected_id'];
    $selected_movie_name = $_POST['selected_movie_name'];
    $selected_username = $_POST['selected_username'];
    $custom_type = $_POST['selectOption'];

    $search = "SELECT 1 FROM custom_list LIMIT 1";
    $is_table_exists = mysqli_query($con, $search);

    if($is_table_exists == TRUE) {}
    else {
        $SQL = "CREATE TABLE custom_list ( 
            `customlist_id` INT(11) NOT NULL AUTO_INCREMENT , 
            `username` VARCHAR(255) NOT NULL , 
            `movie_id` VARCHAR(255) NOT NULL , 
            `movie_name` VARCHAR(255) NOT NULL , 
            `custom_type` VARCHAR(255) NOT NULL , 
            PRIMARY KEY (`customlist_id`))";

            if(mysqli_query($con, $SQL)) {
                echo "Table created successfully";
            } else {
                echo "ERROR: Could not execute $SQL. " . mysqli_error($con);
            }
    }

    $query = "SELECT * FROM custom_list WHERE username = '$selected_username' 
              AND movie_name = '$selected_movie_name' 
              AND custom_type = '".$custom_type."'";
              
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    
    if($count >= 1) {
        echo "Movie already exists in $custom_type list";
        header("refresh:3; url=http://cmpsc431-s3-g-14.vmhost.psu.edu/homepage/homepage.php");
    }
    else {
        $con->query("INSERT INTO custom_list (username, movie_id, movie_name, custom_type)
        VALUES('$selected_username', '$selected_id', '$selected_movie_name', '$custom_type');");
        header("location: ../homepage/homepage.php");
    }
}

else if(isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $con->query("DELETE FROM custom_list WHERE movie_id='$delete_id' ");
    header("location: ../custom_list/custom-lists.php");

}
else {
    echo "ERROR from custom list" . mysqli_error($con);
}
?>