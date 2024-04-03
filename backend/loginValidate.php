<?php

global $db_conn;
session_start();
require_once "../include/dbConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //  echo password_hash("12345678", PASSWORD_DEFAULT);
   // exit; per te gjeneruar kodin hash per '12345678'
//echo 'tr';
//exit;
    $email = $db_conn->escape_string($_POST['email']);
    $password = $db_conn -> escape_string($_POST['password']);
    $validationErrors = array();
    $oldData=array();

    if (empty($email)) {
        $validationErrors['email'] = "Email is required";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $validationErrors['email'] = "Invalid email format!";
    }
    $oldData['email'] = $email ;

    if (empty($password)) {
        $validationErrors['password'] = "Password is required";
    }

    $_SESSION['old'] = $oldData;
    if (!empty($validationErrors)) {
        $_SESSION['login_form_validations'] = $validationErrors;
        header('Location: ../login.php');
        exit;
    }

    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $result_email = $db_conn->query($check_email_sql);


    if ($result_email->num_rows == 0) {
        $validationErrors['email'] = "Email does not exist!";
        $_SESSION['login_form_validations'] = $validationErrors;
        header('Location: ../login.php');
        exit;
    } else {
        $user = $result_email->fetch_assoc();
        if (!password_verify($password, $user['password'])) { //function to check if the provided password matches the hashed password stored in the database
            $validationErrors['password'] = "Password does not match!";
            $_SESSION['login_form_validations'] = $validationErrors;
            header('Location: ../login.php');
        }

    else {
        $_SESSION['id'] = $user['id'];
        $_SESSION["email"] = $email;
        $_SESSION['role'] = $user['role'];


        header('Location: ../profile.php');
      exit;
    }
        }}
?>