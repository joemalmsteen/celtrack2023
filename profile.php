<?php
session_start();
include ("dbconn.php");

$pid = $_GET['pid'];

$sql = "SELECT * FROM participant WHERE pid = $pid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

?>

</html>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="styles/profile.css">

    <title>Profile</title>
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

    <!-- program joined list -->
    <div class="mx-auto col-md-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2" style="color:white">PROFILE</h1>
        </div>

        <div class="col-md-10">
            <div class="card text-black">
                <div class="card-body p-md-5 mx-md-4">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Fullname</td> 
                                <td> </td>
                                <td><?php echo $row['fullname']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">NRIC</td>
                                <td> </td>
                                <td><?php echo $row['nric']; ?></td>
                            </tr>

                            <tr>
                                <td class="font-weight-bold">Email</td>
                                <td> </td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Phone Number</td>
                                <td> </td>
                                <td><?php echo $row['phone']; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Address</td>
                                <td> </td>
                                <td><?php echo $row['address']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->
    <!-- Modal -->
    <div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Program Code</label>
                                <input type="text" class="form-control" id="inputEmail4">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Pin</label>
                                <input type="password" class="form-control" id="inputPassword4">
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