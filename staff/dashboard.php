<?php
session_start();
include("../dbconn.php");

$sid = $_GET['sid'];

$sql = "SELECT * FROM admin WHERE sid='$sid'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$sqlStat = "SELECT * FROM status";
$sqlPart = "SELECT * FROM participant";
$sqlProg = "SELECT * FROM program";

if ($resultStat = mysqli_query($conn, $sqlStat)) {
    // Return the number of rows in result set
    $countStat = mysqli_num_rows($resultStat);
}

if ($resultPart = mysqli_query($conn, $sqlPart)) {
    // Return the number of rows in result set
    $countPart = mysqli_num_rows($resultPart);
}

if ($resultProg = mysqli_query($conn, $sqlProg)) {
    // Return the number of rows in result set
    $countProg = mysqli_num_rows($resultProg);
}

//by month
$sqlProgM = "SELECT COUNT(*) as countPrograms FROM program WHERE MONTH(start_date) = MONTH(CURRENT_DATE())";

if ($resultProgM = mysqli_query($conn, $sqlProgM)) {
    // Check if the query returned any rows
    if (mysqli_num_rows($resultProgM) > 0) {
        $rowProgM = mysqli_fetch_assoc($resultProgM);
        // Assign the count value to $countProgM
        $countProgM = $rowProgM['countPrograms'];
    } else {
        // If there are no rows returned by the query
        $countProgM = 0; // Set default value to 0 or handle appropriately and $countProgM will have a value, even if it's 0
    }
} else {
    // If there's an error in the SQL query
    $countProgM = 0; // Set default value to 0 or handle appropriately
}

$currentYear = date("Y"); // Get the current year

$sqlProgYear = "SELECT COUNT(*) as countPrograms FROM program WHERE YEAR(start_date) = $currentYear";

if ($resultProgYear = mysqli_query($conn, $sqlProgYear)) {
    // Check if the query returned any rows
    if (mysqli_num_rows($resultProgYear) > 0) {
        $rowProgYear = mysqli_fetch_assoc($resultProgYear);
        // Assign the count value to $countProgYear
        $countProgYear = $rowProgYear['countPrograms'];
    } else {
        // If there are no rows returned by the query
        $countProgYear = 0; // Set default value to 0 or handle appropriately
    }
} else {
    // If there's an error in the SQL query
    $countProgYear = 0; // Set default value to 0 or handle appropriately
    echo "Error executing the query: " . mysqli_error($conn);
}


// Fetch programs to categorise them into the tabs by datetime
$currentDateTime = date('Y-m-d H:i:s');
$sqlPast = "SELECT * FROM program 
            WHERE end_date < '$currentDateTime'";
$sqlOngoing = "SELECT * FROM program 
            WHERE start_date <= '$currentDateTime' AND end_date >= '$currentDateTime'";
$sqlUpcoming = "SELECT * FROM program 
            WHERE start_date > '$currentDateTime'";

$resultPast = mysqli_query($conn, $sqlPast);
$resultOngoing = mysqli_query($conn, $sqlOngoing);
$resultUpcoming = mysqli_query($conn, $sqlUpcoming);



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

    <!-- Custom styles for this template -->
    <link href="styles/dashboard.css" rel="stylesheet">

    <title>Dashboard</title>
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
            <h1>DASHBOARD</h1>
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-11 px-md-4">
            <div class="container-fluid">
                <!-- cards to show some info -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">TOTAL PROGRAMS</h5>
                                    <h1 class="card-text"><?php printf($countProg); ?></h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">PROGRAMS THIS MONTH (<?php echo date("F"); ?>)</h5>
                                    <h1 class="card-text"><?php printf($countProgM); ?></h1>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">PROGRAMS THIS YEAR (<?php echo date("Y"); ?>)</h5>
                                    <h1 class="card-text"><?php printf($countProgYear); ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="card-deck pt-4 pb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">TOTAL PARTICIPANTS</h5>
                                    <p class="card-text"><small class="text-muted">Total number of participants that joined CLU programs</small></p>
                                    <h1 class="card-text"><?php printf($countPart); ?></h1>
                                </div>
                            </div>
                            <div class="card pb-4">
                                <div class="card-body">
                                    <h5 class="card-title">POSTING</h5>
                                    <p class="card-text"><small class="text-muted">Number of posting that posted by participant.</small></p>
                                    <h1 class="card-text"><?php printf($countStat); ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link flex-sm-fill text-sm-center active" id="past-tab" data-toggle="tab" data-target="#past" type="button" role="tab" aria-controls="home" aria-selected="true">Past Programs</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link flex-sm-fill text-sm-center" id="ongoing-tab" data-toggle="tab" data-target="#ongoing" type="button" role="tab" aria-controls="home" aria-selected="true">Ongoing Program(s)</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link flex-sm-fill text-sm-center" id="upcoming-tab" data-toggle="tab" data-target="#upcoming" type="button" role="tab" aria-controls="profile" aria-selected="false">Upcoming Programs</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active p-4" id="past" role="tabpanel" aria-labelledby="past-tab">
                                    <p>
                                        <?php
                                            while ($rowProgram = mysqli_fetch_assoc($resultPast)) {
                                                echo "<td>{$rowProgram['progName']}</td>";
                                                echo "<br>";
                                            }
                                        ?> 
                                    </p>
                                </div>
                                <div class="tab-pane fade show  p-4" id="ongoing" role="tabpanel" aria-labelledby="ongoing-tab">
                                    <p>
                                        <?php
                                            while ($rowProgram = mysqli_fetch_assoc($resultOngoing)) {
                                                echo "<td>{$rowProgram['progName']}</td>";
                                                echo "<br>";
                                            }
                                        ?> 
                                    </p>

                                </div>
                                <div class="tab-pane fade  p-4" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                                <p>
                                        <?php
                                            while ($rowProgram = mysqli_fetch_assoc($resultUpcoming)) {
                                                echo "<td>{$rowProgram['progName']}</td>";
                                                echo "<br>";
                                            }
                                        ?> 
                                    </p>
                                </div>
                            </div>
                    </div>
                </div>
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


<!--FOR SIDEBAR-->
<script>
    let btn= document.querySelector('#btn')
    let sidebar = document.querySelector('.sidebar')

    btn.onclick = function (){
        sidebar.classList.toggle('active');
    };
</script>

</html>