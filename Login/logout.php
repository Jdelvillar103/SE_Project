<?php
session_start();//Resumes the session from the other pages (able to access previous stored variables)
session_unset();//Remove all session variables
session_destroy();//destroys the session. When session_start() is run again, it will create a new session (Variables need to be stored again)

$url = "../homepage.php";
header("Location: ".$url);
exit();
 ?>
