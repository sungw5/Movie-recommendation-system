<?php
$con = new mysqli('localhost', 'root', "", "users") or die(mysqli_error($con));

if(isset($_POST['submit'])) {
    $movie_name = $_POST['movie_name'];
    $mpaa = $_POST['mpaa'];
    $running_time = $_POST['running_time'];
    $release_date = $_POST['release_date'];


    $search = "SELECT 1 FROM `movie_recommendation_db` LIMIT 1";
    $is_table_exists = mysqli_query($con, $search);

    if($is_table_exists == TRUE)
    {
        // don't create the table if the table already exists
    }
    
    else
    {
        $SQL = "CREATE TABLE movie_recommendation_db (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            movie_name VARCHAR(255) NOT NULL,
            mpaa VARCHAR(100) NOT NULL,
            running_time VARCHAR(100) NOT NULL,
            release_date VARCHAR(100) NOT NULL)";

        if(mysqli_query($con, $SQL)) {
            echo "Table created successfully";
        } else {
            echo "ERROR: Could not execute $SQL. " . mysqli_error($con);
        }
    }

    $con->query("INSERT INTO movie_recommendation_db (movie_name, mpaa, running_time, release_date) 
                VALUES('$movie_name', '$mpaa', '$running_time', '$release_date');");
    header("location:../homepage/homepage.php");
}
?>

