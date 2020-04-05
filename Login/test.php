<?php
session_start();

    require_once('../mysql-connect.php');

$query = "SELECT * FROM e_commerce.profile";


if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($field1, $field2);
    while ($stmt->fetch()) {
        printf("%s, %s\n", $field1, $field2);
    }
    $stmt->close();
}
?>