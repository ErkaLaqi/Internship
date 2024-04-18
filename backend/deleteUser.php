<?php
global $db_conn;
include "../include/dbConnection.php";
include "../include/getAllRecords.php";

if(isset($_POST["member_id"])) {
    $member_id = mysqli_real_escape_string($db_conn, $_POST["member_id"]);
    $query = "DELETE FROM users WHERE id = '$member_id'";
    $result = mysqli_query($db_conn, $query);
    if ($result) {
        // Deletion successful
        echo json_encode(array("status" => "success", "message" => "User deleted successfully!"));
    } else {
        // Error occurred during deletion
        echo json_encode(array("status" => "error", "message" => "Error deleting user!"));
    }
}


?>

