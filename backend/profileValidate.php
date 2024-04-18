<?php
global $db_conn;
session_start();
include "../include/dbConnection.php";


if(isset($_POST['edit'])) {
$page = $_POST['page'];
if ($page === "profileUpdate") {
    $id = $_SESSION['id'];
} else if ($page === "updateUsers") {
    $id = $_POST['id'];
    }


    $firstname = $db_conn->escape_string($_POST['name']);
    $lastname = $db_conn->escape_string($_POST['lastname']);
    $phone = $db_conn->escape_string($_POST['phone']);
    $birthday = $db_conn->escape_string($_POST['birthday']);
    $email = $db_conn->escape_string($_POST['email']);
    $password = $db_conn->escape_string($_POST['password']);
    $confirmPassword = $db_conn->escape_string($_POST['confirmPassword']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = $db_conn->escape_string($_POST['role']);
    $dob = new DateTime($birthday);
    $now = new DateTime();
    $age = $now->diff($dob)->y;
    $id = $_SESSION['id'];
    // Validation
    $validationErrors = array();
    $alphanumericRegex = '/^[a-zA-Z]+$/';
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    $number = preg_match('/^[0-9]*$/', $phone);
    $phoneNum = preg_match('@^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$@', $phone);

    $select = "select * from users where id='$id'";

    $sql = mysqli_query($db_conn, $select);
    $row = mysqli_fetch_assoc($sql);
    $result = $row['id'];
    $oldEmail = $row['email'];
//    print_r($oldEmail);
//    print_r($email);
//    exit;

    /*    print_r($id);
        print_r($res);
        exit;*/


    /* $row =mysqli_fetch_assoc($sql);*/
    if ($result == $id) {

        $update = "UPDATE users SET ";

        if (preg_match($alphanumericRegex, $firstname)) {
            $update .= " name = '$firstname'";
        } else {
        $validationErrors['name'] = "Name must contain only letters!";
        }

        if (preg_match($alphanumericRegex, $firstname)) {
            $update .= ", lastname = '$lastname'";
        } else {
            $validationErrors['lastname'] = "Lastname must contain only letters!";
        }

        if ($age >= 18) {
            $update .= ", birthday ='$birthday'";
        } else {
            $validationErrors['birthday'] = "You must be at least 18 years old!";
        }

        if (!($phoneNum)) {
            $validationErrors['phone'] = "Phone number must contain only numbers";
        } else {
            $update .= ", phone = '$phone'";
        }

        if ($oldEmail != $email) {
            $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $db_conn->query($check_email_sql);

            if ($result->num_rows > 0) {
                $validationErrors['email'] = "Email already exists!";
            } else if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $update .= ", email = '$email'";
            } else {
                $validationErrors['email'] = "Invalid email format";
            }
        }


        if (!empty($password) && (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)) {
            $validationErrors['password'] = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        } else if (!empty($password) && $password == $confirmPassword &&
            ($uppercase && $lowercase && $number && $specialChars && strlen($password) > 8)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update .= ", password = '$hashed_password'";
        }

        if ($password != $confirmPassword) {
            $validationErrors['confirmPassword'] = "Password does not match";
        }


        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $picture_tmp_name = $_FILES['photo']['tmp_name'];
            $picture_name = $_FILES['photo']['name'];

            $upload_directory = "../img/gallery";
            $destination = $upload_directory . $picture_name;
            $fileType = pathinfo($destination, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'webp');

            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($picture_tmp_name, $destination)) {
                    $update .= ", photo = '$destination'";
                } else {
                    $validationErrors['photo'] = "Failed to upload picture.";
                }
            } else {
                $validationErrors['photo'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            }
        }

        $update .= ", role ='$role'";

        if (!empty($validationErrors)) {
            $_SESSION['profile_form_validations'] = $validationErrors;
            if ($page === "profileUpdate") {
                header('Location: ../profile.php');
                exit;
            } /*else if ($page === "updateUsers") {
            header("Location: ../update.php?id=$id");
            exit;
        }*/
        }

        $update .= " WHERE id = '$id'";

//        print_r($update);
//        exit;
//        echo $update;exit;
        $sql2 = mysqli_query($db_conn, $update);

        if ($sql2) {
            if ($page === "profileUpdate") {
                header('Location: ../profile.php');
                exit;
            } /*else if ($page === "updateusers") {
            header("Location: ../dashboard.php");
            exit;
        }*/
        }
            else {
                //sorry your profile is not updated
                header('location:../logout.php');
            }
        } else {
            //sorry your id is not matched
            header('location:../logout.php');
        }

    }


    ?>

