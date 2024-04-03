<?php
session_start();
include "../include/dbConnection.php";
global $db_conn;
$id=$_SESSION['id'];
if (isset($_POST['submit']) && isset($_FILES['photo'])) {


    echo "<pre>";
    print_r($_FILES['photo']);
    echo "</pre>";
    $img_name = $_FILES['photo']['name'];
    $img_size = $_FILES['photo']['size'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $error = $_FILES['photo']['error'];

    if($error ===0){
        if($img_size>125000){
            $em="Sorry, your file is too large!";
            header("location: indexPhoto.php?error=$em");
        }else{
            $img_ex=pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");

            if(in_array($img_ex_lc, $allowed_exs)) {
               $new_img_name= uniqid("photo", true).'.'.$img_ex_lc;
                $new_img_name= "view".$id.".".$img_ex_lc;
                $img_upload_path= $new_img_name;
                /*print_r($img_upload_path);
                exit;*/
                move_uploaded_file($tmp_name,  $img_upload_path);

                //insert into database
                $sql = "UPDATE users SET photo='$new_img_name' WHERE id='$id'";
             //   $sql= "INSERT INTO users(photo) VALUES($new_img_nam) ";
                mysqli_query($db_conn, $sql);
                header("location: view.php");
            }else{
                $em="You can't upload this file format!";
                header("location: indexPhoto.php?error=$em");
            }
        }
    }else{
        $em="unknown error occured!";
        header("location: indexPhoto.php?error=$em");
    }
}else{
    header("location: indexPhoto.php");
}

//This is the php page for the upload
/*global $db_conn;
session_start();
include_once '../include/dbConnection.php';
$id = $_SESSION['id'];


if (isset($_POST['submit'])) {

    $file = $_FILES['file'];
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array("jpg", "jpeg", "png", "pdf");


    if (in_array($fileActualExt, $allowed)) {

        if ($fileError === 0) {

            if ($fileSize < 500000) {
                //I now need to create a unique ID which we use to replace the name
               // of the uploaded file, before inserting it into our rootfolder
      //If I don't do this, we might end up overwriting the file if we upload a file later with the same name
      //Here I use the user ID of the user to create the first part of the image name
      $fileNameNew = "../profile" . $id . "." . $fileActualExt;
      $fileDestination = 'uploads/' . $fileNameNew;
      move_uploaded_file($fileTempName, $fileDestination);

      $sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
      $result = mysqli_query($db_conn, $sql);

      header("Location: indexPhoto.php?uploadsuccess");
    } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file, try again!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}*/
?>