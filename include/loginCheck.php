<?php

if(!isset($_SESSION['email']) && !isset($_SESSION['id'])) {
   header("Location: login.php");
} elseif (empty($_SESSION['email']) || empty($_SESSION['id'])) {
   header("Location: login.php");
}
?>