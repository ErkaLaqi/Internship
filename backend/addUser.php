<?php

global $db_conn;
session_start();
include "../include/dbConnection.php";
include "fetch_single.php";

if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Save") {
        $name = $db_conn->escape_string($_POST['name']);
        $lastname = $db_conn->escape_string($_POST['lastname']);
        $phone = $db_conn->escape_string($_POST['phone']);
        $birthday = $db_conn->escape_string($_POST['birthday']);
        $email = $db_conn->escape_string($_POST['email']);
        $password = $db_conn->escape_string($_POST['password']);
        $confirmPassword = $db_conn->escape_string($_POST['confirmPassword']);
        $role = $db_conn->escape_string($_POST['role']);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($db_conn, "INSERT INTO users(name, lastname, birthday, phone, email, password,role) VALUES ('" . $name . "','" . $lastname . "','" . $birthday . "','" . $phone . "','" . $email . "','" . $hashedPassword . "','" . $role . "')");
    } else if ($_POST["operation"] == "Edit") {
        if(isset($_POST["member_id"]))
        {
            $id=$_POST["member_id"];
            "SELECT * FROM users WHERE id = '$id' LIMIT 1";

        }




    }
}else{

}
/*include "../include/getAllRecords.php";
global $db_conn;
if (isset($_POST["operation"])) {
    if ($_POST["operation"] == "Save") {
        $statement = $db_conn->prepare("
            INSERT INTO users (name, lastname, birthday, phone, email, password) VALUES (:name, :lastname, :birthday, :phone, :email, :password)");
        $result = $statement->execute(
            array(
                ':name' => $_POST["name"],
                ':lastname' => $_POST["lastname"],
                ':birthday' => $_POST["birthday"],
                ':phone' => $_POST["phone"],
                ':email' => $_POST["email"],
                ':password' => $_POST["password"]

            )
        );
    }
    if ($_POST["operation"] == "Edit") {
        $statement = $db_conn->prepare(
            "UPDATE users
            SET name = :name, lastname = :lastname, birthday = :birthday, phone = :phone, email = :email, password = :password WHERE id = :id");
        $result = $statement->execute(
            array(
                ':name' => $_POST["name"],
                ':lastname' => $_POST["lastname"],
                ':birthday' => $_POST["birthday"],
                ':phone' => $_POST["phone"],
                ':email' => $_POST["email"],
                ':password' => $_POST["password"]
            )
        );
    }
}*/


?>