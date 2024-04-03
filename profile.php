<?php
global $db_conn;

session_start();

include "include/dbConnection.php";

if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header("Location: login.php");
}


// Fetch user details from the database based on the session email
$getUserDetailsQuery = "SELECT * FROM users WHERE id= '".mysqli_real_escape_string($db_conn, $_SESSION['id'])."' ";
$result= mysqli_query($db_conn, $getUserDetailsQuery);
// Check if user exists and get user details
if ($result->num_rows > 0) {
    $userDetails = mysqli_fetch_assoc($result);// Fetch user details
} else {
    // Handle error if user not found
    echo "User details not found!";
    exit;
}

$validationErrors = ['name' => '', 'lastname' => '', 'email' => '', 'password' => '',
    'confirmPassword' => '', 'phone' => '', 'register' => '', 'birthday' => '', 'photo' => ''];
if (isset($_SESSION['profile_form_validations'])) {
    $validationErrors = array_merge($validationErrors, $_SESSION['profile_form_validations']);
    unset($_SESSION['profile_form_validations']); }
//echo "<pre>";
//exit;
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile Update</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
                            <strong>Update Profile</strong>
                        </li>
                    </ol>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="wrapper wrapper-content animated fadeInRightBig">
                        <div class="container px-4 mt-4">

                            <form method="POST" class="profile-form" id="profile-form" enctype='multipart/form-data' action="backend/profileValidate.php">
                                <br><br><br>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <!-- Profile picture card-->
                                        <div class="card mb-4 mb-xl-0">
                                            <h3 class="font-bold">Profile Picture</h3>
                                            <div class="card-body text-center">
                                                <!-- Profile picture image-->
                                                <label for="photo" class="upload-file">
                                                    <img id="profile-photo" class="img-account-profile rounded-circle mb-2 photo-src" src="inspina/<?=$userDetails['photo']?>" alt="" style="width: 300px; height: 300px; object-fit: cover">
                                                    <br><br>
                                                    <!-- Profile picture help block-->
                                                    <input type="file" id="photo" name="photo" class="form-control m-t" accept="image/*" onchange="previewImage(event)" >
                                                </label>
                                                <br>
                                                <div class="error">
                                                    <?php echo $validationErrors['photo']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-8">
                                        <!-- Account details card-->
                                        <div class="card mb-4">
                                            <br><br>
                                            <h3 class="font-bold">Profile Details</h3><br>
                                            <div class="card-body">
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="small mb-1 " for="name">First name</label>
                                                        <input class="form-control m-t" id="name" name = 'name' type="text" placeholder="Enter your first name" value="<?= $userDetails['name'] ?>">
                                                        <div class="error">
                                                            <?php echo $validationErrors['name']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="lastname">Last name</label>
                                                        <input class="form-control m-t" id="lastname" name = 'lastname'  type="text" placeholder="Enter your last name" value="<?= $userDetails['lastname'] ?>">
                                                        <div class="error">
                                                            <?php echo $validationErrors['lastname']; ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Form Group (birthday)-->
                                                <div class="mb-3">
                                                    <br>
                                                    <label class="small mb-1" for="birthday">Birthday</label>
                                                    <input class="form-control m-t" id="birthday" name = 'birthday' type="date" value="<?= $userDetails['birthday'] ?>">
                                                    <div class="error">
                                                        <?php echo $validationErrors['birthday']; ?>
                                                    </div>
                                                </div>

                                                <!-- Form Group (phone)-->
                                                <div class="mb-3">
                                                    <br>
                                                    <label class="small mb-1" for="phone">Phone Number</label>
                                                    <input class="form-control m-t" id="phone" name ="phone" type="" placeholder="Enter your phone number" value="<?= $userDetails['phone'] ?>">
                                                    <div class="error">
                                                        <?php echo $validationErrors['phone']; ?>
                                                    </div>
                                                </div>

                                                <!-- Form Group (email address)-->
                                                <div class="mb-3">
                                                    <br>
                                                    <label class="small mb-1" for="email">Email address</label>
                                                    <input class="form-control m-t" id="email" name = 'email' type="email" placeholder="Enter your email address" value="<?= $userDetails['email'] ?>">
                                                    <div class="error">
                                                        <?php echo $validationErrors['email']; ?>
                                                    </div>
                                                </div>

                                                <!-- Form Group (role)-->
                                                <div class="mb-3">
                                                    <br>
                                                    <label class="small mb-1" for="role">Role</label>
                                                    <input class="form-control m-t" id="role" name = 'role' type="text" value="<?= $userDetails['role'] ?>" readonly>

                                                </div>

                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group (phone number)-->
                                                    <div class="col-md-6">
                                                        <br>
                                                        <label class="small mb-1" for="password">New password</label>
                                                        <input class="form-control m-t" id="password" type="password" name="password" placeholder="Enter your new password" value="">
                                                        <div class="error">
                                                            <?php echo $validationErrors['password']; ?>
                                                        </div>
                                                    </div>
                                                    <!-- Form Group (birthday)-->
                                                    <div class="col-md-6">
                                                        <br>
                                                        <label class="small mb-1" for="confirmPassword">Confirm new password</label>
                                                        <input class="form-control m-t" id="confirmPassword" type="password" name="confirmPassword" placeholder="Enter your new password" value="">
                                                        <div class="error">
                                                            <?php echo $validationErrors['confirmPassword']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="page" value="profileUpdate">
                                                <!-- Save changes button-->
                                                <input type="submit" name="edit" id="edit" class="btn btn-primary m-t" value="Update"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                 <!--   <?php /*if ($userDetails['role'] === 'user'): */?>
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
/*                                    $sql = "SELECT * FROM users where role = 'admin'";
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
                                    */?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    --><?php /*endif; */?>

            <!-- include info-->

<br> <br>

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
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            if (!localStorage.getItem('notificationShown')) {
                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                    };
                    toastr.success('Welcome <?php echo $userDetails['name']; ?>', 'Intership project');
                    localStorage.setItem('notificationShown', true);
                }, 1300);
            }
        });

        function previewImage(event){
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var dataURL = reader.result;
                var profilePhoto =document.getElementById('profile-photo');
                profilePhoto.src = dataURL;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
</body>
</html>
