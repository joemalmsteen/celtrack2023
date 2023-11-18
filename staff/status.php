<?php
session_start();
include "../dbconn.php";

$sid = $_GET['sid'];

$sql = "SELECT * FROM staff WHERE sid = $sid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


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
    <title>CLUMS::Staff</title>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow navbar-expand-lg">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Community Linkages Unit</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <!-- <a class="nav-link" href="#"><i class="bi bi-person-circle"></i>Sign out</a> -->
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Add User</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#">Sign Out</a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php?sid=<?php echo $row['sid']; ?>">
                                <span data-feather="home"></span> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="program.php?sid=<?php echo $row['sid']; ?>">
                                <span data-feather="database"></span> Program List
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:window.location.reload(true)">
                                <span data-feather="framer"></span> Participant's Status <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">
                                <span data-feather="save"></span> Miscellaneous
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Participant's Status</h1>
                </div>

                <!-- participant status list -->
                <?php
                $sqlstatus = "SELECT * FROM status AS s JOIN participant AS p ON s.pid = p.pid ORDER BY s.time desc";
                $restat = mysqli_query($conn, $sqlstatus) or die("error".mysqli_error($conn));
                while($statrow = mysqli_fetch_assoc($restat)) {
                    $div = ' class="mx-auto pt-2 col-md-7"';
                        $card = ' class="card mb-4"';
                        $body = ' class="card-body"';
                        $text = ' class="card-text"';
                        $footer = ' class="card-footer"';
                        $mute = ' class="text-muted"';
                        echo "<div".$div.">";
                        echo "<div".$card.">";
                        echo "<div".$body.">";
                        echo "<h4".$text.">".$statrow['fullname']."</h4>";
                        echo "<p".$text.">".$statrow['feed']."</p>";
                        echo "</div>";
                        echo "<div".$footer.">";
                        echo "<small".$mute.">".$statrow['time']."</small>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>
            </main>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="script/dashboard.js"></script>
</body>

</html>