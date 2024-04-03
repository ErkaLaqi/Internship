<?php
global $db_conn;
include "../include/dbConnection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<!--write here  php script-->
<body>
<a href="indexPhoto.php">Click here to choose a file!</a>
<?php
$sql = "SELECT * FROM users ORDER BY id DESC";
$res=mysqli_query($db_conn,$sql);
if(mysqli_num_rows($res)>0){
    while($photo = mysqli_fetch_assoc($res)){ ?>
<div>
    <img src="<?=$photo['photo']?>">
</div>
  <?php  } }  ?>
</body>
</html>