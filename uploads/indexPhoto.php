<?php
session_start();
include_once "../include/dbConnection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Input</title>
</head>
<!--write here  php script-->
<body>

<?php  if(isset($_POST['error]'])): ?>
<p><?php echo $_POST['error'];?></p>
<?php endif; ?>
 <form class="img-circle" action="imageValidate.php" method="post" autocomplete="off" enctype="multipart/form-data">
     <label for="photo">Image</label>
     <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" value="">
     <input type="submit" name="submit"> Upload</input>
 </form>
</body>
</html>