<?php


require '../homepage/config.php';

session_start();

// Start transaction
$con->begin_transaction();


//Edit items
if(isset($_POST['update_item'])){
    $edit_item_id = $_POST['edit_item_id'];
    $movie_name = $_POST['movie_name'];
    $us_distributor = $_POST['us_distributor'];
    $running_time = $_POST['running_time'];
    $lifetime_gross = $_POST['lifetime_gross'];
    $mpaa = $_POST['mpaa'];


    $sql1 = "UPDATE bo_summary SET movie_name='$movie_name', 
            lifetime_gross='$lifetime_gross'
            WHERE movie_id='$edit_item_id' ";

    $sql2 = "UPDATE movie_summary SET movie_name='$movie_name', 
            us_distributor='$us_distributor', running_time='$running_time', 
            mpaa='$mpaa' WHERE movie_id='$edit_item_id' ";

    if ($con->query($sql1) === TRUE && $con->query($sql2) === TRUE) {
        $con->commit();
        header("location: adminhomepage.php");
    } else {
        $con->rollback();
        echo "Error updating record: " . $con->error;
    }
}

// Delete item
if(isset($_POST['delete'])){

      $delete_id = $_POST['delete_id'];
      $sql1 = "DELETE FROM bo_summary WHERE movie_id='$delete_id' ";
      $sql2 = "DELETE FROM movie_summary WHERE movie_id='$delete_id' ";
      $sql3 = "DELETE FROM movie_crew_data WHERE movie_id='$delete_id' ";
      
      if ($con->query($sql1) === TRUE && $con->query($sql2) === TRUE && $con->query($sql3) === TRUE ) {
          $con->commit();
          header("location: adminhomepage.php");
      }
      else {
        $con->rollback();
        echo "Error deleting record: " . $con->error;
      }
  }



?>