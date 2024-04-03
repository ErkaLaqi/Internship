<?php
session_start();

include "include/dbConnection.php";
global $db_conn;

if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header("Location: login.php");
}

// Fetch user details from the database based on the session email
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

$validationErrors = ['name' => '', 'lastname' => '', 'email' => '', 'password' => '',
    'confirmPassword' => '', 'phone' => '', 'register' => '', 'birthday' => ''];
if (isset($_SESSION['register_form_validations'])) {
    $validationErrors = array_merge($validationErrors, $_SESSION['register_form_validations']);
    unset($_SESSION); }
//echo "<pre>";
//exit;
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Data table libraries-->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">-->

</head>

<body>
<div id="wrapper">
    <!-- Navbar -->
    <?php
    include('include/sidebar.php');
    ?>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <?php
        include 'include/topmenu.php';
        ?>

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Profile</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li class="active">
                        <strong>Profile</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="row animated fadeInRight">
                        <div class="col-md-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Profile Detail</h5>
                                </div>
                                <div>
                                    <div class="ibox-content no-padding border-left-right">
                                        <img alt="image" class="img-responsive" src="inspina/<?=$userDetails['photo']?>" style="width: 300px; height: 300px;" >
                                    </div>
                                    <div class="ibox-content profile-content">
                                        <h4><strong><?= $userDetails['name'] . ' ' . $userDetails['lastname']?></strong></h4>
                                        <p><i class="fa fa-envelope"></i><?= " " . $userDetails['email']?> </p>

                                        <h4 >
                                            Update your profile?
                                        </h4>
                                        <a href="profile.php" type="submit"style="font-size:20px">Click here </i></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="ibox float-e-margins">
                                <?php if ($userDetails['role'] === 'admin'): ?>
                                    <div class="ibox-title">
                                        <h5>Activities</h5>
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
                                <?php endif; ?>

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
                            </div>

                        </div>
                    </div>

                </div>
                <?php
                include 'include/footer.php';
                ?>
            </div>
        </div>

    </div>
</div>




<script>
    $(document).ready(function() {
        // Check if the notification has already been shown
        var shown = '<?php echo isset($_SESSION['has_shown']) ? $_SESSION['has_shown'] : 'false'; ?>';

        if (shown !== 'true') {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Welcome <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>', 'Intership project');

                // Set the flag to indicate that the notification has been shown
                <?php $_SESSION['has_shown'] = 'true'; ?>
            }, 1300);
        }
    });
</script>

</body>
</html>
