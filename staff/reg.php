<?php
session_start();
include "../dbconn.php";

if(isset($_POST['submit'])) {
    $sid = "";
    $fullname = $_POST['fullname'];
    $nric = $_POST['nric'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO admin (sid, fullname, nric, email, phone, address )VALUES (NULL, '$fullname', '$nric', '$email', '$phone', '$address')";

    //echo "Stuck Here! UP";
    if (mysqli_query($conn, $sql)) {
        //header("Location: status.php?userid=".$row['userid']);
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    //echo "Stuck Here!";
    mysqli_close($conn);
}
?>