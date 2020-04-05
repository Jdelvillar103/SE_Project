<?php
session_start();
session_destroy();
unset($_SESSION['email']);
$url = "../homepage.php";
header("Location: ".$url);
exit();
 ?>
