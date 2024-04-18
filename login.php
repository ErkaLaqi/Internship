<?php
session_start();

$validationErrors = ['email' => '','password' => ''];
$oldData = ['email' => '', 'password' => ''];

if (isset($_SESSION['login_form_validations'])) {
    $oldData=array_merge($oldData, $_SESSION['old']);
    $validationErrors = array_merge($validationErrors, $_SESSION['login_form_validations']);
    unset($_SESSION['login_form_validations']);
}
if(isset($_SESSION['id'])){
    header("Location:profile.php");
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Already have an account?</h2>
                <h3 class="font-bold">Login here</h3>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="backend/loginValidate.php" id="myForm" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="email" value="<?php echo $oldData['email']; ?>" name="email" id="email" required="">
                            <div class="errorMessage"> <?php echo $validationErrors['email']; ?> </div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password"  name="password" id="password" required="">
                            <div class="errorMessage"> <?php echo $validationErrors['password']; ?> </div>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b"  id="login" name="login">Login</button>

                        <!--<a href="#">
                            <small>Forgot password?</small>
                        </a> -->

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="register.php">Create an account</a>
                    </form>
                    <p class="m-t">
                        <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>
