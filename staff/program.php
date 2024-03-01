<?php
session_start();
include("../dbconn.php");


// Check if 'sid' is not set in the session
if (!isset($_SESSION['sid'])) {
    // Redirect to login page or display an error message
    header("Location: login.php");
    exit();
}
$sid = $_SESSION['sid'];

$sql = "SELECT * FROM admin WHERE sid='$sid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//program list
$sqlProg = "SELECT * FROM program ORDER BY start_date DESC";
$resultProg = mysqli_query($conn, $sqlProg);
if (!$resultProg) {
    die('Error fetching program list: ' . mysqli_error($conn));
}


$sqlStat = "SELECT * FROM status";
if ($resultStat = mysqli_query($conn, $sqlStat)) {
    // Return the number of rows in result set
    $countStat = mysqli_num_rows($resultStat);
}


// Function to format date in alphabets
function formatDate($dateTimeString) {
    $timestamp = strtotime($dateTimeString);
    return date("j F Y h:i A", $timestamp); // Format: Month Day, Year Hour:Minute AM/PM
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Confirm message for deletion -->
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to cancel this program?");
        }
    </script>

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <title>List Of Program</title>
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
            <a href="logout.php" style="color: red;">
                <i class="bi bi-box-arrow-in-right"></i>
                <span class="nav-item">Log Out</span>
            </a>
        </li>
    </ul>
    </div>

    <div class="main-content">
        <div class="container-fluid d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-0 pb-2 mb-3 border-bottom">
            <h1>LIST OF PROGRAM</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addnew"><i class="bi bi-calendar2-plus"></i> New Program</button>
                        </div>
            </div>
        </div>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-md-5">

            <!-- table for program list -->
            <div class="mx-auto pt-4">
                <!-- search bar to search program -->
                <!--<input class="form-control form-control-lg mb-4" type="text" placeholder="Search by code or program name"> -->

                <!-- table for program list -->
                <table class="table table-bordered rounded-table">
                    <thead class="thead-dark ">
                        <tr>
                            <th style="text-align: center">CODE</th>
                            <th style="text-align: center">PROGRAM</th>
                            <th style="text-align: center">START DATE</th>
                            <th style="text-align: center">END DATE</th>
                            <th style="text-align: center">LOCATION </th>
                            <th style="text-align: center">ACTIVITY MANAGER </th>
                            <th style="text-align: center">ACTION </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                while($rowProg = mysqli_fetch_array($resultProg)) {
                                    $text = ' style="text-align: center""';
                                    echo "<tr>";
                                    echo "<td".$text.">".$rowProg['progID']."</td>";
                                    echo "<td><a href='progInfo.php?progID=".$rowProg['progID']."'>".$rowProg['progName']."</td>";
                                    echo "<td".$text.">".formatDate($rowProg['start_date'])."</td>";
                                    echo "<td".$text.">".formatDate($rowProg['end_date'])."</td>";
                                    echo "<td".$text.">".$rowProg['location']."</td>";
                                    echo "<td".$text.">".$rowProg['manager']."</td>";
                              

                                                // Add the delete button
                                            echo "<td>";
                                            echo "<form action='deletion.php' method='post'>";
                                            echo "<input type='hidden' name='count' value='" . $rowProg['count'] . "' />";
                                            echo "<input type='hidden' name='progID' value='" . $rowProg['progID'] . "' />";
                                            echo "<button type='submit' class='btn btn-danger' onclick='return confirmDelete()'>Cancel</button>";
                                            echo "</form>";
                                            echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="upload.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create New Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">

                                <label for="progID">Program Code</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">CLU</span>
                                    </div>
                                    <input type="text" class="form-control" id="progID" name="progID" aria-label="1234" aria-describedby="basic-addon1" maxlength="4" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="progName">Program Name</label>
                                <input type="text" class="form-control" id="progName" name="progName" required autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="start_date">Start Date & Time</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="end_date">End Date & Time</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="location">Program Location</label>
                                <input type="text" class="form-control" id="location" name="location" required autofocus>
                            </div>
                        </div>
                        <div class="form-row">                            
                            <div class="form-group col-md-6">
                                <label for="manager">Activity Manager</label>
                                <input type="text" class="form-control" id="manager" name="manager" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="hidden" name="sid" value="<?php echo $row['sid']; ?>">
                        <button class="btn btn-primary" type="submit" name="submit">Add Program</button>
                    </div>
                </form>
            </div>
        </div>
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