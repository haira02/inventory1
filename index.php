<?php
    @require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel = "stylesheet" href = "global.css">

</head>

<body data-spy="scroll" data-target="navbar" data-offset="50" style="background-color: #EEE;">

    <div class="jumbotron">
        <div class="container text-center" id="head" style="margin-top: 50px;">
            <h1>Inventory System</h1>

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

        <div id = "container">
        <div class ="sidebar">
            <ul id = "nav1">

    
           <li> <a href="sell.php">Sell</a></li>
            <li><a href="buy.php">Buy</a></li>
            <li><a href="add_item.php">Add Items</a></li>
            <li><a href="add_category.php">Add Item Catagory</a></li>
           <li> <a href="outgoing_table.php">Outgoing</a></li>
           <li> <a href="incoming_table.php">Incoming</a></li>
            <li><a href="item_table.php">Items</a></li>
            <li><a href="category_table.php" class=>Item Catagory</a></li>

        </div>

    </div>
</body>

</html>