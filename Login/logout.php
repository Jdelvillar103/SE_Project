<?php
session_start();//Resumes the session from the other pages (able to access previous stored variables)
unset($_SESSION['ID']);
unset($_SESSION['Valid']);
unset($_SESSION['Unauthorized']);
unset($_SESSION['Verified']);
if(empty($_SESSION['shopping_cart']))
{
    session_unset();
    session_destroy();
}
//session_unset();//Remove all session variables
//session_destroy();//destroys the session. When session_start() is run again, it will create a new session (Variables need to be stored again)

$url = "../index.php";
header("Location: ".$url);
exit();
 ?>
