<!doctype html>
<html lang="en">
    <head>
         <!-- Required meta tags -->
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

         <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <link href="styles/index.css" rel="stylesheet">
        <title>CeLTRACK:: Registration</title>
    </head>
    <body>
        <section class="vh-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col md-20">
                        <div class="card text-black">
                            <div class="row">
                                <div class="col-lg-5 d-flex align-items-center">
                                    <div class="text-black px-3 py-4 p-md-5 mx-md-5">
                                        <div class="text-center mb-4">
                                            <img src="icon.png" alt="" width="200" height="200">
                                            <h1 class="h3 mb-3 font-weight-bold">Community Engagement Linkages Tracker (CeLTrack)</h1>
                                            <h1 class="h6 mb-1 font-weight">UiTM Sarawak Branch</h1>
                                            <p class="mt-5 mb-3 text-muted text-center">&copy; 2023</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 custom-padding">
                                    <div class="card-body">
                                        <form class="form-signin" action="reg.php" method="post">
                                            <!--EMAIL-->
                                            <div class="form-label-group pb-2">
                                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                                <label for="inputEmail">Email address</label>
                                            </div>

                                            <!--NAME-->
                                            <div class="form-label-group pb-2">
                                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Fullname" required autofocus> 
                                                <label for="fullname">Fullname</label>               
                                            </div>

                                            <!--NRIC-->
                                            <div class="form-label-group pb-2">
                                                <input type="number" id="nric" name="nric" class="form-control" placeholder="IC Number" required autofocus>
                                                <label for="nric">NRIC</label>
                                            </div>

                                            <!--PHONE NUMBER-->
                                            <div class="form-label-group pb-2">
                                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" required autofocus>
                                                <label for="phone">Phone Number</label>
                                            </div>

                                            <!--ADDRESS-->
                                            <div class="form-label-group pb-5">
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Address" required autofocus>
                                                <label for="address">Address</label>
                                            </div>

                                            <!--Register Button-->
                                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Register</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    </body>
</html>