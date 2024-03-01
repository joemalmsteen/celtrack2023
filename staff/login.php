<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <link href="styles/index.css" rel="stylesheet">
        <title>Admin Login</title>


    </head>
    <body>
        <section class="vh-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-20">
                        <div class="card text-black">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-1 mx-md-4">
                                        <form class="form-signin" action="loginStaff.php" method="post">

                                                <div class="text-center mb-4">
                                                    <img src="icon.png" alt="" width="150" height="150">
                                                    <h4 class="h5 mb-1 font-weight">UiTM Sarawak Branch</h4>
                                                    <h1 class="h3 mb-1 font-weight-bold">Sign In Administration</h1>
                                                </div>
                                        
                                                <div class="form-label-group">
                                                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                                                    <label for="inputEmail">Email address</label>
                                                    
                                                </div>
                                        
                                                <div class="form-label-group pb-1">
                                                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                        
                                                <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
                                                <div class="d-flex align-items-center justify-content-center pt-4">
                                                    <p class="mb-0 mr-2">Don't have an account?</p>
                                                    <a  class="btn btn-outline-danger" href="regStaff.php">Create new</a>
                                                </div>
                                                <p class="mt-5 mb-3 text-muted text-center">&copy; 2024</p>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center">
                                    <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                    <h1 class="h3 mb-4 font-weight-bold">Community Engagement Linkages Tracker (CeLTrack)</h1>
                                        <p class="medium mb-3">This system is developed by the  Community Linkages Unit is a comprehensive software solution 
                                            designed to streamline and enhance the management of community linkages, engagements, and partnerships. This system 
                                            acts as a centralized hub for monitoring and tracking various connections within and beyond the community. It facilitates 
                                            the seamless coordination of activities, assessments, and evaluations related to community initiatives organised by 
                                            UiTM Sarawak Branch.  This platform also acts as a tool to assess the effectiveness of the community linkages and measure 
                                            the engagement impact. This system is a valuable tool for optimizing community linkages, foster collaboration, and monitor 
                                            the progress of community initiatives.</p>
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