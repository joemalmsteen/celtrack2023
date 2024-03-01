<?php
session_start();
include("dbconn.php");

// Retrieve 'pid' from the session
$pid = $_SESSION['pid']; // Retrieving the participant ID from the session

// Fetch user information from the database based on the 'pid'
$sql = "SELECT * FROM participant WHERE pid = '$pid'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // Access the user's information
    $fullName = $row['fullname'];
    $email = $row['email'];
    $nric = $row['nric'];
    // Retrieve other user-related information as needed
    // ...
} else {
    // Handle the case if user information is not found
    echo "User information not found";
}


// Function to format date in alphabets
function formatDate($dateTimeString) {
    $timestamp = strtotime($dateTimeString);
    return date("j F Y h:i A", $timestamp); // Format: Month Day, Year Hour:Minute AM/PM
}

// Fetch user details based on the progID they join
$sqlProgram = "SELECT * FROM participant p
                    INNER JOIN codeprogram c ON p.pid = c.pid
                    INNER JOIN program pr ON c.progID = pr.progID
                    WHERE p.pid = '$pid'";
$resultProgram = mysqli_query($conn, $sqlProgram);

if (!$resultProgram) {
    die('Error fetching participant details: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="styles/dashboard.css">

    <title>Program Joined</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <img class="mb-1" src="icon.png" alt="" width="45" height="45">
        <a class="navbar-brand" href="dashboard.php?pid=<?php echo $row['pid']; ?>">Community Linkages</a>
        
        <div class="btn-group ml-auto">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#joinprog">Register Program</button>
                <div class="dropdown-divider"></div>
                <a href="logout.php"><button class="dropdown-item text-danger" hreftype="button">Log out</button></a>
                
            </div>
        </div>
    </nav>

    <!--display name-->
    <div class="mx-auto col-md-10 mt-5">
           <div class="row row-cols-2 row-cols-md-1">
            <div class="col mb-4">
                <div class="card h-100 bg-secondary text-white">
                    <div class="card-body">
                        <h6 class="card-title bi bi-person"> Program Joined by</h6>
                        <h1 class=" card-title"><?php echo $row['fullname']; ?></h1>
                    </div>
                </div>
            </div>
    </div>


    <!-- Card displaying activities joined -->
               <div class="col mb-4">
                <div class="card h-100 bg-light text-black ">
                    <div class="card-body">
                        <h3 class="card-title bi bi-journal-check"> Program Joined</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ACTIVITY NAME</th>
                                    <th scope="col">START DATE</th>
                                    <th scope="col">END DATE</th>
                                    <th scope="col">LOCATION</th>
                                    <th scope="col">MANAGER</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($program = mysqli_fetch_assoc($resultProgram)) {
                                        echo '<tr>';
                                        echo '<td>' . $program['progName'] . '</td>';
                                        echo '<td>' . formatDate($program['start_date']) . '</td>';
                                        echo '<td>' . formatDate($program['end_date']) . '</td>';
                                        echo '<td>' . $program['location'] . '</td>';
                                        echo '<td>' . $program['manager'] . '</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                           
                        </table>
                    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>



</body>
</html>
