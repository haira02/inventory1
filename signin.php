<?php
    @require_once('initialized.php');

    if($session->is_logged_in()){
        header("Location: index.php");
    } 

?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/bootstrap.min.css">

</head>


<body style="background-color: #EEE;">
    <div class="jumbotron">


        <nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
            <div class "container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home page</a>
                            <li><a href="signin.php">Login</a>
                                <li><a href="signup.php">SignUp</a>
                    </ul>


                </div>
            </div>
        </nav>



        <div class="container">
            <section>

                <div class="page-header" id="Registration">
                    <h2>Sign In</h2>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <form action="process_sign_in.php" method="post">
                            <div class="form-group">
                                <label for="Fname">Email</label>
                                <input type="email" class="form-control" name="email" id="fname" placeholder="Enter Your Name" required="">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="pass" required="">
                            </div>
                            <div>
                                <input type="submit" name="sign-in" value="Sign In" class="btn btn-lg btn-primary btn-block">

                            </div>


                        </form>
                    </div>
                </div>
            </section>
        </div>

</body>

</html>