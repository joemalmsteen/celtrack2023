<?php
session_start();
include "dbconn.php";

$pid = $_POST['pid'];

$sql = "SELECT * FROM participant WHERE pid = $pid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);



if(isset($_POST['submit'])) {
    $progID = $_POST['progID'];
    

    $sql = "INSERT INTO codeprogram (pid, progID) VALUES ( '$pid','$progID')";

    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php?pid=".$row['pid']);
        exit;
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}


?>