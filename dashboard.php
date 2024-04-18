<?php
global $db_conn;
session_start();
include "include/dbConnection.php";

$validationErrors = ['name' => '', 'lastname' => '', 'email' => '', 'password' => '',
    'confirmPassword' => '', 'phone' => '', 'register' => '', 'birthday' => '', 'role' => ''];

if (isset($_SESSION['modal_form_validations'])) {
    $validationErrors = array_merge($validationErrors, $_SESSION['modal_form_validations']);
    unset($_SESSION['modal_form_validations']); }
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
  <!--  <link rel="stylesheet" href="css/screen.css">
    <link rel="stylesheet" href="css/style.css">-->

    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css">

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


                <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'manager') : ?>
                    <button type="button"  id="addButton" name="addButton" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">
                        + Add New User
                    </button>
                <?php endif; ?>



                <br>
                <!-- ADD USER POP-UP FORM -->
                    <div class="modal inmodal" id="modalForm" name="modalForm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated flipInY">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Add New Details</h4>
                                    <small class="font-bold"></small>
                                </div>
                                <form action="backend/addUser.php" id="modal-form" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Firstname</label>
                                        <input type="text" name="name" id="name" class="form-control" autocomplete="given-name" value="" />
                                        <div class="errorMessage">  <?php echo $validationErrors['name']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control" autocomplete="family-name" value="" />
                                        <div class="errorMessage">  <?php echo $validationErrors['lastname']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input type="date" name="birthday" id="birthday" autocomplete="off" value="" />
                                        <div class="errorMessage">  <?php echo $validationErrors['birthday']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="phone" id="phone" class="form-control" autocomplete="off" value="" />
                                        <div class="errorMessage"> <?php echo $validationErrors['phone']; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" autocomplete="off" value="" />
                                        <div class="errorMessage"> <?php echo $validationErrors['email']; ?>
                                        </div>
                                    </div>

                                    <?php
                                    if($_SESSION['role'] == 'admin'){?>
                                        <div class="form-group">
                                            <label class="small mb-1" for="role">Role</label>
                                            <select class="form-control" name="role" id="role">
                                                <option value="admin">Admin</option>
                                                <option value="manager">Manager</option>
                                                <option value="user" >User</option>
                                            </select>
                                        </div>
                                    <?php }
                                    ?>
                                    <?php
                                    if($_SESSION['role'] == 'manager'){?>
                                        <div class="form-group">
                                            <label class="small mb-1" for="role">Role</label>
                                            <input class="form-control" id="role" name = 'role' type="text" value="User" readonly>
                                        </div>
                                    <?php }
                                    ?>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password"  class="form-control" autocomplete="off" value="" />
                                        <div class="errorMessage"> <?php echo $validationErrors['password']; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" autocomplete="off" value="" />
                                        <div class="errorMessage">  <?php echo $validationErrors['confirmPassword']; ?>
                                        </div>
                                    </div>

                                </div>

                                    <div id="success"> </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="operation" id="operation">
                                    <input type="hidden" name="member_id" id="member_id">
                                    <input type="submit" class="btn btn-primary"  name="action" id="action"  value="Save">
                                    <button type="button" name="close" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


            <br>

            <div class="">
                <div class="table-responsive">

                    <table id="membersTable" class="display" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Birthday</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Birthday</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
<!-- create modal dialog for display detail info for edit on click button edit-->
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

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<!--<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>-->
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.js"></script>

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Toastr -->
<script src="js/plugins/toastr/toastr.min.js"></script>
<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>


<!--<script src="js/modal-form.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"> </script>
<script>

    var dataTable;
    $(document).ready(function() {

        dataTable = $('#membersTable').DataTable({
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "info": true,
            "ajax": {
                url: "backend/fetchTable.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [0, 3, 4],
                    "orderable": false
                }
            ]
        });


        <!--script js for editing data-->


        $.validator.addMethod("passwordRule", function (value, element) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d.@$!%*?&]{8,}$/.test(value);
        }, 'Password must contain at least one uppercase, one lowercase, one digit, one special character')

        $.validator.addMethod("lettersOnly", function (value, element) {
            return /^[a-zA-Z]+$/.test(value);
        }, 'Only letters allowed!')

        $.validator.addMethod("phoneNum", function (value, element) {
            return /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/.test(value);
        }, 'Phone number is not valid!')

        $.validator.addMethod("over18", function(value) {
            var birthday = new Date(value);

            var today = new Date();
            var age = today.getFullYear() - birthday.getFullYear();
            var monthDiff = today.getMonth() - birthday.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
                age--;
            }
            return age >=18;
        });

        $("#modal-form").validate({
            rules: {
                name: {
                    required: true,
                    lettersOnly: true
                },
                lastname: {
                    required: true,
                    lettersOnly: true
                },
                birthday: {
                    required: true,
                    over18: true
                },
                phone: {
                    required: true,
                    phoneNum: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    passwordRule: true
                },
                confirmPassword: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },

            },
            messages: {
                name: {
                    required: "Please enter user firstname!",
                    lettersOnly: "Name should include letters only!"
                },
                lastname: {
                    required: "Please enter user lastname!",
                    lettersOnly: "Lastname should include letters only!"
                },
                birthday: {
                    required: "Please enter user birthday!",
                    over18: "User must be +18 years old!"
                },
                phone: {
                    required: "Please enter user phone number!",
                    phoneNum: "Enter a valid phone number!"
                },
                password: {
                    required: "Please provide a password!",
                    minlength: "Password should be at least 8 characters long",
                    passwordRule: "Password should contain at least 1 uppercase , 1 lowercase, 1 digit , and 1 special character and also be 8 characters long!"
                },
                confirmPassword: {
                    required: "Please confirm password!",
                    minlength: "Password should be at least 8 characters long",
                    equalTo: "Password does not match, please enter the same password as above!"
                }

            }

        })

        $('#addButton').click(function(){
            $('#modal-form')[0].reset();
            $('.modal-title').text("Add New User Details");
            $('#action').val("Save");
            $('#operation').val("Save");
        });

        $('#action').click(function (e) {
            $('.modal-title').text("ADD NEW USER")
            e.preventDefault();
            if ($(this).valid()) {
                $.ajax({
                    url: '../inspina/backend/addUser.php',
                    type: 'POST',
                    data: $("#modal-form").serialize(),
                    dataType: "text",
                    success:function (response){

                        /*$('#success').text("Form Submit Success!");*/
                        $('#modalForm').modal('hide');
                        dataTable.ajax.reload();

                    }
                });
            }

        });

        $(document).on('click', '.update', function(){
            var member_id = $(this).data("id");


            $.ajax({
                url:"../inspina/backend/fetch_single.php",
                method:"POST",
                data:{member_id:member_id},
                dataType:"json",
                success:function(data)
                {
                    /*$('#name').val(data.name);
                    $('#lastname').val(data.lastname);
                    $('#birthday').val(data.birthday);
                    $('#phone').val(data.phone);
                    $('#email').val(data.email);
                    $('#role').val(data.role);
                    $('#password').closest('.form-group').hide();
                    $('#confirmPassword').closest('.form-group').hide();*/

                     $.each($('#modalForm').find(':input'), function (i, e){
                          const el = $(e);
                          const field = el.attr('id');
                          el.val(data[field]).trigger('change');
                      });

                    $('#modalForm').modal('show');
                    $('.modal-title').text("Edit Member Details");
                    $('#member_id').val(member_id);
                    $('#action').val("Save");
                    $('#operation').val("Edit");
                }
            })
        });

        $(document).on('hidden.bs.modal', '#modalForm', function (e) {
            $(this).find(':input').val('').trigger('change');
        })


        $(document).on('click', '.delete', function(){
            var member_id = $(this).data("id");
            if(confirm("Are you sure you want to delete this user?"))
            {
                $.ajax({
                    url:"../inspina/backend/deleteUser.php",
                    method:"POST",
                    data:{member_id:member_id},
                    success:function(data)
                    {
                        dataTable.ajax.reload();
                    }
                });
            }
            else
            {
                return false;
            }
        });
    });






</script>


</body>
</html>
