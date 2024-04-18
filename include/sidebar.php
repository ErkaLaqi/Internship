<?php
global $db_conn;

include "dbConnection.php";
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

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs"> <strong class="font-bold"><?php echo $userDetails['name']; ?></strong>
                             </span>
                                <!-- Add user role here if available -->
                                <?php if(isset($userDetails['role'])): ?>
                                <span class="text-muted text-xs block">
                                    <?php echo $userDetails['role']; ?> <b class="caret"></b></span>
                                <?php endif; ?>
</span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.php">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php">Logout</a></li> <!--kujdes coje tek logout-->
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="home.php"><i class="fa fa-home" style="font-size:20px"></i><span class="nav-label">Home</span></a>
                </li>
            <li>
                <a href="dashboard.php"><i class="fa fa-th-large" style="font-size:20px"></i><span class="nav-label">Users</span></a>

            </li>

          <!--  <?php /*if($userDetails['role'] === 'admin'){
                */?>
                <li>
                    <a href="dashboard.php"><i class="fa fa-th-large" style="font-size:20px"></i><span class="nav-label">Dashboard</span></a>

                </li>
            <?php /*}
            elseif ($userDetails['role'] === 'user'){
            */?>
                <li>
                    <a href="contacts.php"><i class="fa fa-th-large" style="font-size:20px"></i><span class="nav-label">Contact an Admin</span></a>

                </li>
            --><?php /*}

            */?>



        </ul>

    </div>
</nav>