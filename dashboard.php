<?php
session_start();
include("dbconn.php");

$sqlUser = $_GET['pid'];

$sql = "SELECT * FROM participant WHERE pid='$sqlUser'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


//display the number of program joined by 
$sqlJoin = "SELECT pid 
            FROM codeprogram WHERE pid = $sqlUser";

if ($resultJoin = mysqli_query($conn, $sqlJoin)) {
    // Return the number of rows in result set
    $countProg = mysqli_num_rows($resultJoin);
}

//display the number of badges joined by 
$sqlBadgeNum = "SELECT achievement 
            FROM codeprogram WHERE pid = $sqlUser";

if ($resultBadgeNum = mysqli_query($conn, $sqlBadgeNum )) {
    // Return the number of rows in result set
    $countBadgeNum = mysqli_num_rows($resultBadgeNum);
}

// Fetch the badges for the user
$sqlBadges = "SELECT badgeType, achievement FROM codeprogram WHERE pid = $sqlUser";
$resultBadges = mysqli_query($conn, $sqlBadges);



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

    <link rel="stylesheet" href="styles/dashboard.css">

    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img class="mb-1" src="icon.png" alt="" width="45" height="45">
        <a class="navbar-brand" href="dashboard.php?pid=<?php echo $row['pid']; ?>">Community Linkages</a>
        
        <div class="btn-group ml-auto">
            <button type="button" class="btn btn-secondary dropdown-toggle"  data-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#joinprog">Register Program</button>
                <div class="dropdown-divider"></div>
                <a href="logout.php"><button class="dropdown-item text-danger" hreftype="button">Log out</button></a>
                
            </div>
        </div>
    </nav>

    <div class="mx-auto col-md-10 mt-5">
        <div class="row row-cols-2 row-cols-md-1">
            <div class="col mb-4">
                <div class="card h-100 bg-secondary text-white">
                    <div class="card-body">
                        <h6 class="card-title bi bi-person"> Profile</h6>
                        <h1 class=" card-title"><?php echo $row['fullname']; ?></h1>
                        <a href="profile.php?pid=<?php echo $row['pid']; ?>" class="stretched-link text-white"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 bg-secondary text-white ">
                    <div class="card-body">
                        <h6 class="card-title bi bi-journal-check"> Program Joined</h6>
                        <h1 class="card-title"><?php printf($countProg); ?></h1>
                        <a href="program.php" class="stretched-link text-white disabled"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100 bg-secondary text-white">
                    <div class="card-body">
                        <h6 class="card-title bi bi-award"> Badges Collected</h6>
                        <h1 class="card-title"><?php printf($countBadgeNum); ?></h1>
                        <a href="#" class="stretched-link text-white" data-toggle="modal" data-target="#badges"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto col-md-7 mt-5">
        <div class="card border-4 bg-light mb-3">
            <div class="card-body">
                <h3 class="card-title" style="text-align: center;">My Posting</h3>
                <p class="card-text"  style="text-align: center;"><i>Engage, share, and showcase your community impact here.</i></p>
                
                <a href="status.php?pid=<?php echo $row['pid']; ?>"><button class="button"><span>View </span></button></a>
                
            </div>
        </div>
    </div>

    <!-- Modal badges -->
    <div class="modal fade" id="badges" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" style="max-width: 400px;">
                <div class="modal-body" style="margin: 0 auto;">
                <?php
                    $resultBadges = mysqli_query($conn, $sqlBadges);

                    if ($resultBadges) {
                        while ($badgeRow = mysqli_fetch_assoc($resultBadges)) {
                            echo '<div class="badge text-center">';
                            echo '<i class="bi bi-award-fill" style="font-size: 2em; margin-right: 20px;"></i>';
                            echo '<span class="achievement" style="font-size: 20px;">' . $badgeRow['achievement'] . '</span>';
                            echo '<br>';
                            echo '<span class="badge-type" style="color: gray; font-size: 17px;">' . $badgeRow['badgeType'] . '</span>';
                            echo '<br>';
                            echo '<br>';
                            echo '</div>';
                            echo '<hr>'; 
                        }
                    } else {
                        echo '<p>Error fetching badges.</p>';
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
    



    <!-- Modal for Register New Program -->
    <form action="codeJoin.php" method="post">
        <div class="modal fade" id="joinprog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Join New Program</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <!--program code-->
                                <div class="form-group col-md-6">
                                    <label for="inputProg">CLU Code</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputProg">CLU</span>
                                        </div>
                                        <input type="text" class="form-control" name="progID" id="progID" placeholder="1234" aria-label="1234" aria-describedby="basic-addon1" maxlength="4">
                                    </div>
                                </div>
                            </div>
                            <span style="color:red;">*Please get the CLU code from your Activity Manager*</span>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                            <button class="btn btn-primary" type="submit" name="submit">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>

    <!-- The actual snackbar -->
    <div id="snackbar"></div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    <script>
        $(function() {
            $.snackbar({content: "Coming Soon", timeout: 5000});
        });
    </script>
</body>

</html>