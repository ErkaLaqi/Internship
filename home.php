<?php
global $db_conn;
session_start();
include "include/dbConnection.php";
/*if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header("Location: login.php");
}*/
?>


<!DOCTYPE html>

<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboards</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">


    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- dataTable -->


</head>

<body>


<div id="wrapper">

    <?php include "include/sidebar.php";?>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">

            <?php include "include/topmenu.php";?>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2>Update profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="profile.php">Profile</a>
                        </li>
                        <li class="active">
                            <strong>Home</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <br> <br>
            <div class="container-fluid">
                <div class="card img-shadow embed-responsive-4by3">
                    <div class="container">
                        <h2 style="text-align: center;">content here</h2>
                    </div>
                </div>
                <?php
                include 'include/footer.php';
                ?>
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!--<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>-->
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.js"></script>


<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>



<!--<script src="js/modal-form.js"></script>-->




</body>
</html>
