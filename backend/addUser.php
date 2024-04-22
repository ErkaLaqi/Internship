<?php

global $db_conn;
session_start();
include "../include/dbConnection.php";
include "../include/getAllRecords.php";
/*print_r("hyri"); exit;*/
/*include "fetch_single.php";*/



/* kontrolli i butonit */
if (isset($_POST["operation"])) {

    $name = $db_conn->escape_string($_POST['name']); // Te jete required; shkronja
    $lastname = $db_conn->escape_string($_POST['lastname']); // Te jete required; shkronja
    $phone = $db_conn->escape_string($_POST['phone']); // Te jete required; te jene nr
    $birthday = $db_conn->escape_string($_POST['birthday']); // Te jete required; te jete valid; plus 18
    $email = $db_conn->escape_string($_POST['email']); // Te jete required; te jete valid; te jete unik
    $password = $db_conn->escape_string($_POST['password']); // Te jete required; te jete e njejte me konfirm pass
    $confirmPassword = $db_conn->escape_string($_POST['confirmPassword']); // Te jete required
    $role = $db_conn->escape_string($_POST['role']); // Te jete required; Te jete vlere admin ose user
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $dob = new DateTime($birthday);
    $now = new DateTime();
    $age = $now->diff($dob)->y;

    $alphanumericRegex = '/^[a-zA-Z]+$/';
    $validationErrors = array();

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $phoneNum = preg_match('@^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$@', $phone);

    if (empty($name)) {
        $validationErrors['name'] = "Name is required";
    } elseif (!preg_match($alphanumericRegex, $name)) {
        $validationErrors['name'] = "Name must contain only letters";
    }

//lastname validation
    if (empty($lastname)) {
        $validationErrors['lastname'] = "Lastname is required";
    } elseif (!preg_match($alphanumericRegex, $lastname)) {
        $validationErrors['lastname'] = "Lastame must contain only letters";
    }
    //birthday validation
    if (empty($age)) {
        $validationErrors['birthday'] = "Birthday is required";
    } else if ($age < 18) {
        $validationErrors['birthday'] = "You must be at least 18 years old.";
    }
//phone number validation
    if (empty($phone)) {
        $validationErrors['phone'] = "Phone number is required";
    } elseif (!$phoneNum) {
        $validationErrors['phone'] = "Phone number must contain only numbers";
    }
//email validation
    if (empty($email)) {
        $validationErrors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErrors['email'] = "Invalid email format";
    }

    if (!empty($validationErrors)) {
        $_SESSION['modal_form_validations'] = $validationErrors;
        exit;
    }

    if ($_POST["operation"] === "Save") {
//check if email exists

        $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $db_conn->query($check_email_sql);
        if ($result->num_rows > 0) {
            $validationErrors['email'] = "Email already exists!";
            $_SESSION['modal_form_validations'] = $validationErrors;
            header('Location: ../dashboard.php');
            exit;
        }

        $allowed_roles = array("user", "manager", "admin");
        if (!in_array($role, $allowed_roles)) {
            $validationErrors['role'] = "Invalid role provided";
            $_SESSION['modal_form_validations'] = $validationErrors;
            exit;
        }

        $loggedInUserId = $_SESSION['id'];
        mysqli_query($db_conn, "INSERT INTO users(name, lastname, birthday, phone, email, password, role, supervisor_id) 
VALUES ('$name', '$lastname', '$birthday', '$phone', '$email', '$hashedPassword', '$role', '$loggedInUserId')");

        if (mysqli_affected_rows($db_conn) > 0) {
            echo json_encode(array("status" => "success", "message" => "User added successfully."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Failed to add user."));
        }
    } else if ($_POST["operation"] === "Edit") {
        if(isset($_POST["member_id"])) {
            $id = $_POST["member_id"];
            $check_email_sql = "SELECT * FROM users WHERE email = '$email' AND id != '$id'";
            $result = $db_conn->query($check_email_sql);
            if ($result->num_rows > 0) {
                $validationErrors['email'] = "Email already exists!";
                $_SESSION['modal_form_validations'] = $validationErrors;
                header("Location: ../dashboard.php");
                exit;
            }else{

                $update = "UPDATE users SET ";

                $update .= "name = '$name', ";
                $update .= "lastname = '$lastname', ";
                $update .= "birthday = '$birthday', ";
                $update .= "phone = '$phone', ";
                $update .= "email = '$email', ";
                $update .= "password = '$hashedPassword', ";
                $update .= "role = '$role' ";
                $update .= "WHERE id = '$id'";
            }

// Execute the SQL update query
            mysqli_query($db_conn, $update);

            if (mysqli_affected_rows($db_conn) > 0) {
                echo json_encode(array("status" => "success", "message" => "User updated successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Failed to update user."));
            }

        }
    }
}
?>