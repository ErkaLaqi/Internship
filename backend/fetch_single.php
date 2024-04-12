<?php
global $db_conn;
include "../include/dbConnection.php";
include "../include/getAllRecords.php";
if(isset($_POST["member_id"]))
{
    $output = array();
    $statement = $db_conn->prepare(
        "SELECT * FROM users WHERE id = '".$_POST["member_id"]."' LIMIT 1"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output["id"] = $row["id"];
        $output["name"] = $row["name"];
        $output["lastname"] = $row["lastname"];
        $output["birthday"] = $row["birthday"];
        $output["phone"] = $row["phone"];
        $output["email"] = $row["email"];

    }
    echo json_encode($output);
}
?>
