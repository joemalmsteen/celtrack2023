<?php
session_start();
include "../dbconn.php";

// Check if 'sid' is not set in the session
if (!isset($_SESSION['sid'])) {
    // Redirect to login page or display an error message
    header("Location: login.php");
    exit();
}

$sid = $_SESSION['sid'];
$progID = $_GET['progID'];

$sql = "SELECT * FROM admin WHERE sid = $sid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


// Fetch additional details based on $progID
$sqlDetails = "SELECT * FROM program WHERE progID='$progID'";
$resultDetails = mysqli_query($conn, $sqlDetails);
$rowDetails = mysqli_fetch_array($resultDetails);

//program list
$sqlProg = "SELECT * FROM program ORDER BY start_date DESC";
$resultProg = mysqli_query($conn, $sqlProg);
if (!$resultProg) {
    die('Error fetching program list: ' . mysqli_error($conn));
}

$sqlCode = "SELECT * FROM codeprogram WHERE progID='$progID'";
$resultCode = mysqli_query($conn, $sqlCode);


// Function to format date in alphabets
function formatDate($dateTimeString) {
    $timestamp = strtotime($dateTimeString);
    return date("j F Y h:i A", $timestamp); // Format: Month Day, Year Hour:Minute AM/PM
}

// Fetch user details based on the progID they join
$sqlParticipants = "SELECT * FROM participant p
                    INNER JOIN codeprogram c ON p.pid = c.pid
                    INNER JOIN program pr ON c.progID = pr.progID
                    WHERE pr.progID = '$progID'";
$resultParticipants = mysqli_query($conn, $sqlParticipants);

if (!$resultParticipants) {
    die('Error fetching participant details: ' . mysqli_error($conn));
}

?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <title>Program Details</title>
</head>

<body>
<div class="sidebar d-flex flex-column justify-content-between">
        <div class="top"> 
            <div class="logo">
                <span>Community Linkages</span>
            </div>
            <i class="bi bi-list" id="btn"></i>
        </div>
        <div class="user">
            <img class="icon mb-2" src="icon.png" alt="">
            <div>
                <p class="bold h4">WELCOME, </p>
                <p><?php echo $row['fullname']; ?></p>
            </div>
        </div>
        <ul>
            <li>
                <a href="dashboard.php?sid=<?php echo $sid; ?>" class="stretched-link text-black disabled">
                    <i class="bi bi-front"></i>
                    <span class="nav-item h6">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="program.php?sid=<?php echo $sid; ?>" class="stretched-link text-black disabled">
                    <i class="bi bi-list-check"></i>
                    <span class="nav-item h6">List Of Program</span>
                </a>
            </li>
            <li>
                <a href="status.php?sid=<?php echo $sid; ?>" class="stretched-link text-black disabled">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="nav-item h6">Participant's post</span>
                </a>
            </li>
        </ul>
        <ul class="mt-auto">
        <li>
            <a href="logout" style="color: red;">
                <i class="bi bi-box-arrow-in-right"></i>
                <span class="nav-item">Log Out</span>
            </a>
        </li>
    </ul>
    </div>




    <div class="main-content">
        <div class="container-fluid d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
            <h1><?php echo $rowDetails['progName']; ?></h1>
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-md-5">

        
            <!-- table for program list -->
            <div class="mx-auto pt-4">
                <p ><strong>ACTIVITY MANAGER : </strong><?php echo $rowDetails['manager']; ?></p>
                <p><strong>PROGRAM DATE/TIME : </strong><?php echo formatDate($rowDetails['start_date']); ?> - <?php echo formatDate($rowDetails['end_date']); ?></p>
                <p><strong>VENUE : </strong><?php echo $rowDetails['location']; ?></p>
                <p><strong>CODE : </strong><?php echo $rowDetails['progID']; ?></p>
                

                <!-- table for program list -->
                <table class="table table-bordered rounded-table">
                    <thead class="thead-dark ">
                        <tr>
                            <th style="text-align: center">NRIC</th>
                            <th style="text-align: center">PARTICIPANT'S NAME</th>
                            <th style="text-align: center">EMAIL</th>
                            <th style="text-align: center">PHONE</th>
                            <th style="text-align: center">ADDRESS </th>
                            <th style="text-align: center">ACTION </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($participant = mysqli_fetch_assoc($resultParticipants)) {
                                echo '<tr>';
                                echo '<td style="text-align: center">' . $participant['nric'] . '</td>';
                                echo '<td style="text-align: center">' . $participant['fullname'] . '</td>';
                                echo '<td style="text-align: center">' . $participant['email'] . '</td>';
                                echo '<td style="text-align: center">' . $participant['phone'] . '</td>';
                                echo '<td style="text-align: center">' . $participant['address'] . '</td>';
                                echo "<td>";
                                // Button to trigger the modal
                                echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#giveBadgesModal' . $participant['pid'] . '">Give Badges</button>';


                                        // Modal for giving badges
                                        echo '<div class="modal fade" id="giveBadgesModal' . $participant['pid'] . '" tabindex="-1" role="dialog" aria-labelledby="giveBadgesModalLabel" aria-hidden="true">';

                                        echo '  <div class="modal-dialog" role="document">';
                                        echo '    <div class="modal-content">';
                                        echo '      <div class="modal-header">';
                                        echo '        <h5 class="modal-title" id="giveBadgesModalLabel">Badges</h5>';
                                        echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                        echo '          <span aria-hidden="true">&times;</span>';
                                        echo '        </button>';
                                        echo '      </div>';
                                        echo '      <div class="modal-body">';
                                       //<!-- Add your form elements and logic for giving badges here -->';
                                       echo '       <form action="giveBadges.php?progID=' . $progID . '" method="post">';
                                        
                                        // Fetch $rowCode inside the participant loop
                                        $rowCode = mysqli_fetch_array($resultCode);

                                         // Hidden input to store participant ID
                                        echo '          <input type="hidden" name="pid" value="' . $participant['pid'] . '" />';

                                        // Achievement input
                                        echo '          <label for="achievement">Achievement:</label>';
                                        echo '          <input type="text" class="form-control" id="achievement" name="achievement" value="' . $rowCode['achievement'] . '" required autofocus>';
                                        echo '          <br>';
                                        echo '          <input type="hidden" name="badgeType" value="' . $rowCode['badgeType'] . '" />';
                                        echo '          <label for="badgeType">Select Badge Rank:</label>';
                                        echo '          <select name="badgeType" id="badgeType">';

                                        // Add your badge options dynamically here
                                        echo '            <option value="Diamond">Diamond</option>';
                                        echo '            <option value="Platinum">Platinum</option>';
                                        echo '            <option value="Gold">Gold</option>';
                                        echo '            <option value="Silver">Silver</option>';
                                        echo '          </select>';
                                        echo '          <br>';

                                        echo '          <button type="submit" class="btn btn-success">Give Badges</button>';
                                        echo '        </form>';
                                        echo '      </div>';
                                        echo '    </div>';
                                        echo '  </div>';
                                        echo '</div>';
                                echo "</td>";
                                echo '</tr>';
                            }
                        ?>
                       
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="script/dashboard.js"></script>
</body>

<script>
    let btn= document.querySelector('#btn')
    let sidebar = document.querySelector('.sidebar')

    btn.onclick = function (){
        sidebar.classList.toggle('active');
    };
</script>


</html>