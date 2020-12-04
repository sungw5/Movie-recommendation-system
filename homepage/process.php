<?php
$mysqli = new mysqli('localhost', 'root', "", "users") or die(mysqli_error($mysqli));

if(isset($_POST['submit'])) {
    $movie_title = $_POST['movie_name'];
    $total_gross = $_POST['total_gross'];
    $running_time = $_POST['running_time'];
    $release_date = $_POST['release_date'];

    $SQL = "CREATE TABLE movie_recommendation_db (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        movie_name VARCHAR(30) NOT NULL,
        total_gross VARCHAR(30) NOT NULL,
        running_time VARCHAR(70) NOT NULL,
        release_date VARCHAR(70) NOT NULL)";

    if(mysqli_query($mysqli, $SQL)) {
        echo "Table created successfully";
    } else {
        echo "ERROR: Could not execute $SQL. " . mysqli_error($mysqli);
    }

    $mysqli->query("INSERT INTO movie_recommendation_db (movie_name, total_gross, running_time, release_date) 
                    VALUES('$movie_name', '$total_gross', '$running_time', '$release_date');") or die($mysqli->error);
    header("location:../homepage/homepage.php");
}
?>