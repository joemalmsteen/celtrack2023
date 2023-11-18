<?php
session_start();
include "dbconn.php";

$pid = $_POST['pid'];

$sql = "SELECT * FROM participant WHERE pid = $pid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//$sqlstatus = "SELECT * FROM status WHERE pid = $pid";
//$restat = mysqli_query($conn, $sqlstatus);

if(isset($_POST['submit'])) {
    $feed = $_POST['feed'];
    //$time = getdate();

    $sql = "INSERT INTO status (time, feed, pid) VALUES (sysdate(), '$feed', '$pid')";

    if (mysqli_query($conn, $sql)) {
        //header("Location: status.php?userid=".$row['userid']);
        header("Location: status.php?pid=".$row['pid']);
        exit;
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>