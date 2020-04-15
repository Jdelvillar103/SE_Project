<?php
session_start();
session_destroy();
unset($_SESSION['email']);
$url = "loginPage.php";
header("Location: ".$url);
exit();
 ?>
