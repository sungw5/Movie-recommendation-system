<?php


require '../homepage/config.php';

session_start();


if(isset($_POST['delete'])){
      // sql to delete a record
      $delete_id = $_POST['delete_id'];
      $sql1 = "DELETE FROM bo_summary WHERE movie_id='$delete_id' ";
      $sql2 = "DELETE FROM movie_summary WHERE movie_id='$delete_id' ";
      $sql3 = "DELETE FROM movie_crew_data WHERE movie_id='$delete_id' ";
      
      if ($con->query($sql1) === TRUE && $con->query($sql2) === TRUE && $con->query($sql3) === TRUE ) {
        echo '<script>window.location.href="adminhomepage.php"</script>';
      }
      else {
        echo "Error deleting record: " . $con->error;
      }
  }



?>