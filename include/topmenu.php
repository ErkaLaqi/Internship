<?php
global $db_conn;

include "include/dbConnection.php";
include "loginCheck.php";

$email = $_SESSION['email'];
$id = $_SESSION['id'];

// Fetch user details from the database based on the session email
$getUserDetailsQuery = "SELECT * FROM users WHERE email = '$email'";
$result= mysqli_query($db_conn,$getUserDetailsQuery);
// Check if user exists and get user details
if ($result->num_rows > 0) {
    $userDetails = $result->fetch_assoc(); // Fetch user details
} else {
    // Handle error if user not found
    echo "User details not found!";
    exit;
}
?>

<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <!--Todo: Shenojme emrin e personit qe logohet -->
                <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+
                    <?php
                    echo $userDetails['name'];
                    ?>

                    <?php
                    //isset($_SESSION['name']) ? $_SESSION['name'] : " "; ose si me poshte
                   /* if(!isset($_SESSION['name'])) {
                        echo "problem";
                    }else {
                        echo done;
                    }//echo $_SESSION['name'];*/?>
                </span>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>