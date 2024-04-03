<?php
global $db_conn;
session_start();
include "../include/dbConnection.php";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $firstname = $db_conn->escape_string($_POST['name']);
    $lastname = $db_conn->escape_string($_POST['lastname']);
    $phone = $db_conn->escape_string($_POST['phone']);
    $birthday = $db_conn->escape_string($_POST['birthday']);
    $email = $db_conn->escape_string($_POST['email']);
    $password = $db_conn->escape_string($_POST['password']);
    $confirmPassword = $db_conn->escape_string($_POST['confirmPassword']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $dob = new DateTime($birthday);
    $now = new DateTime();
    $age = $now->diff($dob)->y;

    $alphanumericRegex = '/^[a-zA-Z]+$/';
    $validationErrors = array();
    $oldData=array();

//echo 'tr';
//exit;

    $check_term = isset($_POST['agree-term']);
    if(!$check_term){
        $validationErrors['agree-term'] = "Please accept the agreement terms!";
    }

    if (empty($firstname)) {
        $validationErrors['name'] = "Name is required";
    } elseif (!preg_match($alphanumericRegex, $firstname)) {
        $validationErrors['name'] = "Name must contain only letters";
    }
    $oldData['name'] = $firstname ;


    if (empty($lastname)) {
        $validationErrors['lastname'] = "Lastname is required";
    } elseif (!preg_match($alphanumericRegex, $lastname)) {
        $validationErrors['lastname'] = "Lastame must contain only letters";
    }
    $oldData['lastname'] = $lastname ;


    if (empty($email)) {
        $validationErrors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErrors['email'] = "Invalid email format";
    }
    $oldData['email'] = $email ;

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (empty($phone)) {
        $validationErrors['phone'] = "Phone number is required";
    } elseif (!($number)) {
        $validationErrors['phone'] = "Phone number must contain only numbers";
    }
    $oldData['phone'] = $phone ;

    if (empty($password)) {
        $validationErrors['password'] = "Password is required";
    } else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $validationErrors['password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }


    if (empty($confirmPassword)) {
        $validationErrors['confirmPassword'] = "Password is required";
    }

    if ($password != $confirmPassword) {
        $validationErrors['confirmPassword'] = "Password does not match";
    }

    if (empty($age)) {
        $validationErrors['birthday'] = "Birthday is required";
    } else if ($age < 18) {
        $validationErrors['birthday'] = "You must be at least 18 years old.";
    }
    $oldData['birthday'] = $birthday ;

    $_SESSION['old'] = $oldData;

    if (!empty($validationErrors)) {
        $_SESSION['register_form_validations'] = $validationErrors;
        header('Location: ../register.php');
        exit;
    }

    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $db_conn->query($check_email_sql);
    if ($result->num_rows > 0) {
        $validationErrors['email'] = "Email already exists!";
        $_SESSION['register_form_validations'] = $validationErrors;
        header('Location: ../register.php');
        exit;
    }
    $role='user';
    $photo= '../img/profile-icon.jpg';
    $sql = "INSERT INTO users (name, lastname, birthday, phone, email, password, role) 
        VALUES ('$firstname', '$lastname', '$birthday', '$phone', '$email', '$hashedPassword', '$role')";
  // echo "$sql";
   //exit;
  // print_r($sql);
  //  exit;
    if ($db_conn->query($sql)) {
        header('Location: ../login.php');
        exit;
    } else {
        $validationErrors['register'] = "Problem tek te dhenat";
        $_SESSION['register_form_validations'] = $validationErrors;
        header('Location: ../register.php');
        exit;


    }
}
?>