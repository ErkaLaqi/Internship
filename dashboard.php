<?php
global $db_conn;
session_start();
include "include/dbConnection.php";
if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
    header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboards</title>
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
                            <strong>Dashboard</strong>
                        </li>
                    </ol>
                </div>
            </div>
<br> <br>
            <div class="container-fluid">
                <div class="card img-shadow embed-responsive-4by3">
            <div class="container">
                <br>

           <!--     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="addUserProfile">
                    Add User Profile
                </button>-->



                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">
                      + Add New User
                    </button>
                <br>
                    <div class="modal inmodal" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated flipInY">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Add User</h4>
                                    <small class="font-bold">Add new user details in the specific fields below.</small>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Firstname</label>
                                        <input type="text" name="name" id="name" class="form-control" value="" required=""/>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Lastname</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" value="" required=""/>
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input type="date" name="birthday" id="birthday" value="" required=""/>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="name" id="name" class="form-control" value="" required=""/>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="number" name="phone" id="phone" class="form-control" value="" required=""/>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" value="" required=""/>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" value="" required=""/>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


            <br>

            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" >
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Phone Number</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
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
                toastr.success('Welcome', 'Intership project');
                localStorage.setItem('notificationShown', true);
            }, 1300);
        }
    });
</script>
</body>
</html>
