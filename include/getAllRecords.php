<?php

function get_total_all_records()
{
    global $db_conn;
    include "../include/dbConnection.php";
    $statement = $db_conn->prepare("SELECT * FROM users");
    $statement->execute();
    $result = $statement->fetchAll();
    return $statement->rowCount();
}
?>