<?php
    @
    require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="style/bootstrap.min.css">

</head>

<body data-spy="scroll" data-target="navbar" data-offset="50" style="background-color: #EEE;">

    <div class="jumbotron">
        <div class="container text-center" id="head" style="margin-top: 50px;">
            <h2>Notifications</h2>

        </div>

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
                        <li><a href="index.php">Home page</a></li>
                        <li><a href="signin.php">Login</a></li>
                        <li><a href="signup.php">SignUp</a></li>
                        <?php

                            if($session->is_logged_in()){
                                echo "<li><a href ='notify.php'>Notification</a></li>";
                                echo "<li><a href='process_log_out.php'>Log Out</a></li>";
                            }

                        ?>
                    </ul>

                </div>

        </nav>

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Notifications</th>
                </tr>
                <?php

                    $notfication = Notification::find_all();
                    
                    for ($i=0; $i < count($notfication); $i++) { 
                        if($notfication[$i]->token == 0){
                            echo "<tr>";
                            echo "<th class='success'>{$notfication[$i]->msg}</th>";
                            echo "</tr>";
                            $notfication[$i]->token = 1;
                            $notfication[$i]->update();
                        } else {
                            echo "<tr>";
                            echo "<td>{$notfication[$i]->msg}</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
        </div>

    </div>
</body>

</html>