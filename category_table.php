<?php
    @require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    if(isset($_GET['mode'])){
        $d_cate = Category::find_by_id($_GET['mode']);
        $d_cate->delete();
        header('Location: category_table.php');
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
            <h2>Item Categories</h2>

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

        <table class="table" style="width: 60%; margin-left: 20%; margin-top: 30px;">
            <tr>
                <th>Category Id</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?PhP
                $cates = Category::find_all();
                for ($i=0; $i < count($cates); $i++) { 
                    echo "<tr>";
                    echo "<td>{$cates[$i]->c_id}</td>";
                    echo "<td>{$cates[$i]->disc}</td>";
                    echo "<td><a href='add_category.php?id={$cates[$i]->id}'>Edit</a></td>";
                    echo "<td><a href='Category_table.php?mode={$cates[$i]->id}'>Delete</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>

</html>