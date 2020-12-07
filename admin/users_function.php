<?php

require '../homepage/config.php';

$con->begin_transaction();

$user_id = 0;

$input = filter_input_array(INPUT_POST);
$username = mysqli_real_escape_string($con, $input["username"]);
$password = mysqli_real_escape_string($con, $input["password"]);
$user_type = mysqli_real_escape_string($con, $input["user_type"]);

if($input['action'] === 'edit') {
    $query = "UPDATE user_registration SET username='$username', password='$password', user_type='$user_type' WHERE user_id='".$input['user_id']."'";
    if($con->query($query) == TRUE) {
        $_SESSION['message'] = "Record has been updated!";
        $con->commit();
    } else {
        $con->rollback();
    }
}

if($input['action'] === 'delete') {
    $query = "DELETE FROM user_registration WHERE user_id='".$input['user_id']."'";
    if($con->query($query) == TRUE) {
        $con->commit();
        $_SESSION['message'] = "Record has been deleted!";
    } else {
        $con->rollback();
    }
}
echo json_encode($input);
?>