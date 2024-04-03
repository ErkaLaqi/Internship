<?php
global $db_conn;
session_start();
include "include/dbConnection.php";
if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header("Location: login.php");
}

$getUserDetailsQuery = "SELECT * FROM users WHERE  id= '".mysqli_real_escape_string($db_conn, $_SESSION['id'])."' ";
$result= mysqli_query($db_conn,$getUserDetailsQuery);
// Check if user exists and get user details
if ($result->num_rows > 0) {
    $userDetails = mysqli_fetch_assoc($result); // Fetch user details
} else {
    // Handle error if user not found
    echo "User details not found!";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact an Admin</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
        <?php include "include/sidebar.php";?>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <?php include "include/topmenu.php";?>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Contacts</h2>

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <?php if ($userDetails['role'] === 'user'): ?>
                <div class="ibox-title">
                    <h5>Contact an Admin</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM users where role = 'admin'";
                            $result = $db_conn->query($sql);
                            if($result){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $name = $row['name'];
                                    $lastname = $row['lastname'];
                                    $email = $row['email'];
                                    echo '<tr>
                                                <td>'.$name.'</td>
                                                <td>'.$lastname.'</td>
                                                <td>'.$email.'</td>
                                                <td>
            <button class="btn btn-primary"><a href="#" style="color: #FFFFFF">Contact</a></button>
        </td>
        </tr>
                ';
                                };
                            }
                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>


           <!-- <div class="col-lg-4">
                <div class="contact-box">
                    <a href="profile.php">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="img/a1.jpg">
                            <div class="m-t-xs font-bold">CEO</div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>Alex Johnatan</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>

                    </div>
                    <div class="clearfix"></div>
                        </a>
                </div>
            </div>-->

        </div>
        </div>
            <?php
            include 'include/footer.php';
            ?>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>


</body>

</html>
