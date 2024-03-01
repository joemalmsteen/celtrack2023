<?php

$sname= "localhost";
$uname= "celtrack2023db";
$password = " ";
$db_name = "celtrack2023db";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


date_default_timezone_set('Asia/Kuala_Lumpur');
?>