<?php
session_start();
include "../dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $badgeType = $_POST["badgeType"];
    $achievement = $_POST["achievement"];

    // Perform additional validation if needed

    // Assuming you have a unique identifier for the participant, adjust this based on your actual database structure
    $pid = $_POST["pid"]; // You need to add a hidden input in your form to store the participant ID
    //var_dump($pid);

    // Update the participant record with badge details
    $sqlUpdateParticipant = "UPDATE codeprogram SET badgeType='$badgeType', achievement='$achievement' WHERE pid='$pid' ";

    if (mysqli_query($conn, $sqlUpdateParticipant)) {

        echo '<script>';
        echo 'alert("Badge details updated successfully!");';
        echo 'window.location.href = "program.php";'; // Redirect using JavaScript
        echo '</script>';

       // header("Location: program.php"); // Redirect to the page displaying ongoing programs
        exit();

    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle invalid requests or redirect to the appropriate page
    header("Location: dashboard.php");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
