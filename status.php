<?php
session_start();
include "dbconn.php";

$pid = $_GET['pid'];

$sql = "SELECT * FROM participant WHERE pid = $pid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$sqlstatus = "SELECT * FROM status WHERE pid = $pid";
$restat = mysqli_query($conn, $sqlstatus);
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <title>CLUMS::HOME</title>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Unit Jaringan Komuniti</a>
        <div class="btn-group ml-auto">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <button class="dropdown-item" type="button">Register Program</button>
                <button class="dropdown-item" type="button">Update Status</button>
                <div class="dropdown-divider"></div>
                <button class="dropdown-item text-danger" type="button">Log out</button>
            </div>
        </div>
    </nav>

    <!-- program joined list -->
    <div class="mx-auto col-md-7">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">My Status</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addnew"><i class="bi bi-clipboard-plus"></i> New Post</button>
                </div>
            </div>
        </div>

        <?php
        while($statrow = mysqli_fetch_array($restat)) {
            $card = ' class="card mb-4"';
            $body = ' class="card-body"';
            $text = ' class="card-text"';
            $footer = ' class="card-footer"';
            $mute = ' class="text-muted"';
            echo "<div>";
            echo "<div".$card.">";
            echo "<div".$body.">";
            echo "<p".$text.">".$statrow['feed']."</p>";
            echo "</div>";
            echo "<div".$footer.">";
            echo "<small".$mute.">".$statrow['time']."</small>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- modal -->
    <!-- Modal -->
    <form action="upload.php" method="post">
    <div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">New Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Update Status</label>
                            <textarea class="form-control" name="feed" id="feed" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="pid" value="<?php echo $row['pid']; ?>">
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </div>
            </div>
        </div>
    </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

</body>

</html>