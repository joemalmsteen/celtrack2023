<?php
include("../dbconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve program ID from the form submission
    $count = $_POST['count'];
    $progID = $_POST['progID'];

    // Perform the deletion in the database
    $sqlCancel = "DELETE FROM program WHERE count = '$count'";
    $resultCancel = mysqli_query($conn, $sqlCancel);

    $sqlRemove = "DELETE FROM codeprogram WHERE progID = '$progID'";
    $resultRemove = mysqli_query($conn, $sqlRemove);


    if ($resultCancel) {
        // Deletion successful
        header("Location: program.php"); // Redirect to the page displaying ongoing programs
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting program: " . mysqli_error($conn);
    }

    if ($resultRemove) {
        // Deletion successful
        header("Location: program.php"); // Redirect to the page displaying ongoing programs
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting program: " . mysqli_error($conn);
    }

}


?>
