<?php
session_start();
include("../dbconn.php");

$sid = $_GET['sid'];

$sql = "SELECT * FROM admin WHERE sid = $sid";
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
    <title>Participants' Post</title>
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
            <h1>PARTICIPANTS' POSTS</h1>
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-md-4">
            <div class="container-fluid">
                <!-- Cards to show participant statuses -->
                <div class="row">
                    <?php
                        $sqlstatus = "SELECT * FROM status AS s JOIN participant AS p ON s.pid = p.pid ORDER BY s.time desc";
                        $restat = mysqli_query($conn, $sqlstatus) or die("error".mysqli_error($conn));
                        while($statrow = mysqli_fetch_assoc($restat)) {
                            echo '<div class="col-md-4 mb-4">';
                            echo '<div class="card">';
                            echo '<div class="card-body">';
                            echo '<h4 class="card-title">'.$statrow['fullname'].'</h4>';
                            echo '<p class="card-text">'.$statrow['feed'].'</p>';
                            echo '</div>';
                            echo '<div class="card-footer">';
                            echo '<small class="text-muted">'.$statrow['time'].'</small>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
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

<script>
    let btn= document.querySelector('#btn')
    let sidebar = document.querySelector('.sidebar')

    btn.onclick = function (){
        sidebar.classList.toggle('active');
    };
</script>


</html>

