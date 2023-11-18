<?php
session_start();
include("../dbconn.php");

$sid = $_GET['sid'];

$sql = "SELECT * FROM staff WHERE sid='$sid'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//program list
$sqlProg = "SELECT * FROM program ORDER BY date DESC";
$resultProg = mysqli_query($conn, $sqlProg);
//$rowProg = mysqli_fetch_array($resultProg);

$sqlStat = "SELECT * FROM status";
if ($resultStat = mysqli_query($conn, $sqlStat)) {
    // Return the number of rows in result set
    $countStat = mysqli_num_rows($resultStat);
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
                            <a class="nav-link active" href="javascript:window.location.reload(true)">
                                <span data-feather="database"></span> Program List <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="status.php?sid=<?php echo $row['sid']; ?>">
                                <span data-feather="framer"></span> Participant's Status
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
                    <h1 class="h2">Program List</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addnew"><i class="bi bi-calendar2-plus"></i> New Program</button>
                        </div>
                    </div>
                </div>

                <!-- table for program list -->
                <div class="mx-auto pt-4">
                    <!-- search bar to search program -->
                    <input class="form-control form-control-lg mb-4" type="text" placeholder="Search by code or program name">

                    <!-- table for program list -->
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="text-align: center">CODE</th>
                                <th style="text-align: center">PROGRAM NAME</th>
                                <th style="text-align: center">START DATE</th>
                                <th style="text-align: center">LOCATION</th>
                                <th style="text-align: center">ACTION </th>
                                <!-- <th>PPROGRAM INFO</th>
                                <th>PARTICIPANT LIST</th>
                                <th>PROGRAM FEEDBACK</th> -->
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                    while($rowProg = mysqli_fetch_array($resultProg)) {
                                        $text = ' style="text-align: center""';
                                        echo "<tr>";
                                        echo "<td".$text.">".$rowProg['code']."</td>";
                                        echo "<td>".$rowProg['name']."</td>";
                                        echo "<td".$text.">".$rowProg['date']."</td>";
                                        echo "<td".$text.">".$rowProg['location']."</td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    }
                                ?>
                                <!--
                                <td style="text-align: center">CLU010</td>
                                <td>Program ICT Warriors Komuniti Belia Sri Aman</td>
                                <td style="text-align: center">24/11/2022</td>
                                <td style="text-align: center">22</td>
                                <td style="text-align: center">
                                    <a type="button" class="btn btn-info" href="program/info.html" data-toggle="tooltip" data-placement="top" title="Program Info"><i class="bi bi-info-circle"></i></a>
                                    <a type="button" class="btn btn-primary" href="program/participant.html" data-toggle="tooltip" data-placement="top" title="Participants Info"><i class="bi bi-person-lines-fill"></i></a>
                                    <a type="button" class="btn btn-success" href="" data-toggle="tooltip" data-placement="top" title="Program Feedback"><i class="bi bi-clipboard-data"></i></a>
                                </td>
                                -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create New Program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <!-- <label for="inputEmail4">Program Code</label>
                                <input type="text" class="form-control" id="inputEmail4"> -->
                                <label for="inputProg">Program Code</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputProg">CLU</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="1234" aria-label="1234" aria-describedby="basic-addon1" maxlength="4">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Pin</label>
                                <input type="text" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Program Name</label>
                                <input type="text" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Start Date</label>
                                <input type="date" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Program Location</label>
                                <input type="text" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Expected Number of Participants</label>
                                <input type="number" class="form-control" id="inputPassword4">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" type="submit">Add Program</button>
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

</html>