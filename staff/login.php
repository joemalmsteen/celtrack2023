<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <!-- <link href="styles/index.css" rel="stylesheet"> -->
        <title>CLUMS</title>
    </head>
    <body>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-10">
                        <div class="card text-black">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <form class="form-signin" action="loginStaff.php" method="post">
                                            <div class="">
                                                <div class="text-center mb-4">
                                                    <img class="mb-4" src="icon.png" alt="" width="150" height="150">
                                                    <h1 class="h3 mb-1 font-weight-bold">MyCLUMS</h1>
                                                    <h1 class="h4 mb-1 font-weight-bold">UiTM Cawangan Sarawak</h1>
                                                </div>
                                        
                                                <div class="form-label-group pb-4">
                                                    <label for="inputEmail">Email address</label>
                                                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                                </div>
                                        
                                                <div class="form-label-group pb-4">
                                                    <label for="inputPassword">Password</label>
                                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                                </div>
                                        
                                                <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
                                                <div class="d-flex align-items-center justify-content-center pt-4">
                                                    <p class="mb-0 mr-2">Don't have an account?</p>
                                                    <button type="button" class="btn btn-outline-danger">Create new</button>
                                                </div>
                                                <p class="mt-5 mb-3 text-muted text-center">&copy; 2022</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">A system to monitor the future of our community</h4>
                                        <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                          exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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