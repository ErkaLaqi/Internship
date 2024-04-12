<?php
global $db_conn;
include "../include/dbConnection.php";
include "../include/getAllRecords.php";

if(isset($_POST["member_id"]))
{
    $statement = $db_conn->prepare(
        "DELETE FROM users WHERE id = :id"
    );
    $result = $statement->execute(

        array(':id' =>   $_POST["member_id"])

    );
}

?>

