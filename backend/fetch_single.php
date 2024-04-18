<?php

include "../include/dbConnection.php";
include "../include/getAllRecords.php";
global $db_conn;

if (isset($_POST["member_id"])) {
    $id = $_POST["member_id"];
    $sql = "SELECT id, name, lastname, birthday, phone, email, role FROM users WHERE id = '$id'";
    $result = mysqli_query($db_conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);
        // Remove hashed password from the fetched data
        unset($userData['password']);
        echo json_encode($userData);
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to fetch user data."));
    }
}

?>
