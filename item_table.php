<?php
    @require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    if(isset($_GET['mode'])){
        $item = Item::find_by_id($_GET['mode']);
        $item->delete();

        header("Location: item_table.php");
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
            <h2>Items</h2>

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

        <table class="table" style="width: 80%; margin-left: 10%; margin-top: 30px;">
            <tr>
                <th>Item Code</th>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Total</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
                $items = Item::find_all();
                for ($i=0; $i < count($items); $i++) { 
                    $category = Category::find_by_id($items[$i]->category);
                    echo "<tr>";
                    echo "<td>{$items[$i]->code}</td>";
                    echo "<td>{$items[$i]->disc}</td>";
                    echo "<td>{$category->disc}</td>";
                    echo "<td>{$items[$i]->amount}</td>";
                    echo "<td>{$items[$i]->price}</td>";
                    echo "<td>".$items[$i]->amount * $items[$i]->price."</td>";
                    echo "<th><a href='add_item.php?id={$items[$i]->id}'>Edit</a></th>";
                    echo "<th><a href='item_table.php?mode={$items[$i]->id}'>Delete</a></th>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>

</html>