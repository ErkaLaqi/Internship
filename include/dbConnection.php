<?php

global $db_conn;
$servername = "localhost";
$username = "root";
$password = "Grid2000!?";
$dbname = "projektintership";
$port = 3306;

$db_conn = new mysqli($servername, $username, $password, $dbname, $port);

if($db_conn -> connect_error){
    die ("Connection failed: " . $db_conn ->connect_error);
}
?>





