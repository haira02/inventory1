<?php
    @require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    if(isset($_GET['mode'])){
        $outgoing = Outgoing::find_by_id($_GET['mode']);
        $outgoing->delete();

        header("Location: outgoing_table.php");
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
            <h2>Sold items</h2>

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

        <table class="table" style="width: 90%; margin-left: 5%; margin-top: 30px;">
            <tr>
                <th>Date</th>
                <th>Invoice</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Selling Price</th>
                <th>Total</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?PhP
                $outgoing = Outgoing::find_all();
                for ($i=0; $i < count($outgoing); $i++) { 
                    $item = Item::find_by_id($outgoing[$i]->i_code);
                    echo "<tr>";
                    echo "<td>{$outgoing[$i]->date}</td>";
                    echo "<td>{$outgoing[$i]->invoice_no}</td>";
                    echo "<td>{$outgoing[$i]->customer_name}</td>";
                    echo "<td>{$item->disc}</td>";
                    echo "<td>{$outgoing[$i]->amount}</td>";
                    echo "<td>{$item->price}</td>";
                    echo "<td>".$outgoing[$i]->amount * $item->price."</td>";
                    echo "<td><a href='sell.php?id={$outgoing[$i]->id}'>Edit</a></td>";
                    echo "<td><a href='outgoing_table.php?mode={$outgoing[$i]->id}'>Delete</a></td>";
                    echo "<tr/>";
                }
            ?>

        </table>
    </div>
</body>

</html> 