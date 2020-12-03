<?php
$mysqli = new mysqli('localhost', 'root', "", "users") or die(mysqli_error($mysqli));

if(isset($_POST['submit'])){
    $movie_title = $_POST['movie_title'];
    $total_gross = $_POST['total_gross'];
    $running_time = $_POST['running_time'];
    $release_date = $_POST['release_date'];
    
    $mysqli->query("INSERT INTO movie_recommendation_db (movie_title, total_gross, running_time, release_date) 
                    VALUES('$movie_title', '$total_gross', '$running_time', '$release_date');") or die($mysqli->error);
    header("location:../homepage/homepage.php");
}
?>