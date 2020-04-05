<?php
DEFINE('DB_USER','root');
DEFINE('DB_PASSWORD','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','e_commerce');
DEFINE('DB_PORT','3306');
DEFINE('DB_SOCKET','');

$dbc = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
OR die('COULD NOT CONNECT TO MYSQL '.mysqli_connect_error());

 ?>
