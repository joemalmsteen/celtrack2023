<?php
session_start();
include ("../dbconn.php");

$sid = $_POST['sid'];

$sql = "SELECT * FROM admin WHERE sid = $sid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//$sqlstatus = "SELECT * FROM status WHERE pid = $pid";
//$restat = mysqli_query($conn, $sqlstatus);

if(isset($_POST['submit'])) {

    $progID = $_POST['progID'];
    $progName = $_POST['progName'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $location = $_POST['location'];
    $manager = $_POST['manager'];
    //$time = getdate();

    $sql = "INSERT INTO program (progID, progName, start_date, end_date, location, manager) VALUES ('$progID', '$progName', '$start_date', '$end_date', '$location', '$manager')";

    if (mysqli_query($conn, $sql)) {
        //header("Location: status.php?userid=".$row['userid']);
        header("Location: program.php?sid=".$row['sid']);
        exit;
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>