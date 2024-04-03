
<?php
session_start();
$validationErrors = ['name' => '', 'lastname' => '', 'email' => '', 'password' => '',
    'confirmPassword' => '', 'phone' => '', 'register' => '', 'birthday' => ''];
$oldData= ['name' => '', 'lastname' => '', 'email' => '', 'password' => '',
    'confirmPassword' => '', 'phone' => '', 'register' => '', 'birthday' => ''];
if (isset($_SESSION['register_form_validations'])) {
    $oldData = array_merge($oldData, $_SESSION['old']);
    $validationErrors = array_merge($validationErrors, $_SESSION['register_form_validations']);
    unset($_SESSION['register_form_validations']); }
if(isset($_SESSION['id'])){
    header("Location: editProfile.php");
}

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create a new account</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
<h3>Create a new account</h3>
            <br>
            <form class="m-t" role="form" action="backend/regValidate.php" id="myForm" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" value="<?php echo $oldData['name']; ?>" name="name" id="name" required="">
                    <div class="errorMessage">  <?php echo $validationErrors['name']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Lastname"  value="<?php echo $oldData['lastname']; ?>" name="lastname" id="lastname" required="">
                    <div class="errorMessage">  <?php echo $validationErrors['lastname']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" name="birthday" id="birthday" value="<?php echo $oldData['birthday']; ?>" required=""/>
                    <div class="errorMessage">  <?php echo $validationErrors['birthday']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Phone Number" value="<?php echo $oldData['phone']; ?>" name="phone" id="phone" required="">
                    <div class="errorMessage"> <?php echo $validationErrors['phone']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Mail" value="<?php echo $oldData['email']; ?>"name="email" id="email" required="">
                    <div class="errorMessage"> <?php echo $validationErrors['email']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required="">
                    <div class="errorMessage"> <?php echo $validationErrors['password']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" required="">
                    <div class="errorMessage">  <?php echo $validationErrors['confirmPassword']; ?>
                    </div>
                </div>

                <div class="form-group">
                        <div class="checkbox i-checks"><label>
                                <input type="checkbox" name="agree-term" id="agree-term" required=""/>
                                <i></i> Agree the terms and policy </label></div>
                    <!--<div class="errorMessage">
                        <?php /*echo $validationErrors['agree-term']; */?>
                    </div>-->
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b"  id="register" name="register">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="login.php">Login</a>
            </form>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
