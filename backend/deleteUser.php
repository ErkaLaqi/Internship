<?php
global $db_conn;
include "../include/dbConnection.php";
include "../include/getAllRecords.php";

if(isset($_POST["member_id"])) {
    $member_id = $_POST["member_id"];
    $query = "DELETE FROM users WHERE id = '$member_id'";
    $result = mysqli_query($db_conn, $query);
    if ($result) {
        // Deletion successful
        echo "User deleted successfully!";
    } else {
        // Error occurred during deletion
        echo "Error deleting user!";
    }
}

?>

