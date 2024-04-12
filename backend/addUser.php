<?php

global $db_conn;
session_start();
include "../include/dbConnection.php";
include "../include/getAllRecords.php";
/*print_r("hyri"); exit;*/
/*include "fetch_single.php";*/

if (isset($_POST["operation"])) {
    if ($_POST["operation"] === "Save") {
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

        if (mysqli_affected_rows($db_conn) > 0) {
            echo json_encode(array("status" => "success", "message" => "User added successfully."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Failed to add user."));
        }
    } else if ($_POST["operation"] === "Edit") {
        if(isset($_POST["member_id"]))
        {
            $id=$_POST["member_id"];
            $statement = $db_conn->prepare(
            "UPDATE users SET name = 'name', lastname = 'lastname', birthday = 'birthday', phone = 'phone', email = 'email', password = 'password', role= 'role' WHERE id= '$id' "
            );
            $result = $statement->execute();

        }


    }
}
?>