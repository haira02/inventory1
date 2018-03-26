<?php
    @require_once('initialized.php');

    $message = '';
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    if(isset($_POST['add_c'])){
        $record = [];
        $record['c_id'] = $_POST['c_id'];
        $record['disc'] = $_POST['disc'];
        $same = Category::find_by_id_i($record['c_id']);
        if($same){
            $message = "The same category already exists";
        } else {
            $cate = Category::make($record);
            $cate->create();
            $message = "Category Successfully Added!";
        }
    }

    if(isset($_POST['update_c'])){
        $id = $_POST['hidden_id'];
        $cate = Category::find_by_id($id);
        $cate->c_id = $_POST['c_id'];
        $cate->disc = $_POST['disc'];

        $cate->update();

        $message = "Category Successfully Updated!";
        header('Location: ./category_table.php');
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $cate = Category::find_by_id($id);
    } else {
        unset($cate);
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

        <div class="container" style="margin-top: 50px;">
            <section>
                <div ckass="page-header" id="ItemType">
                    <h2>Item Category</h2>
                </div>
                <h4 style="color: green;">
                <?php

                    echo $message;

                ?>
                </h4> <br />
                <div class="row">
                    <div class="col-sm-3">
                     <?php
                        if(isset($item)){
                            echo "";
                        } else {
                            echo "";
                        }
                     ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="ItemId">Id</label>
                                <input type="text" class="form-control" id="itemid" name="c_id" required=""
                                <?php

                                    if(isset($cate)){
                                        echo "value = '{$cate->c_id}' ";
                                    }

                                ?>
                                >
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <input type="text" class="form-control" id="desc" name="disc" required=""
                                <?php

                                    if(isset($cate)){
                                        echo "value = '{$cate->disc}' ";
                                    }

                                ?>
                                >
                            </div>
                            <div>
                            <?php

                                if(isset($cate)){
                                    echo "<input type='hidden' name='hidden_id' value='{$cate->id}'>";
                                    echo "<input type='submit' class='btn btn-default' value='Update' name='update_c'>";
                                } else {

                                    echo "<input type='submit' class='btn btn-default' value='Add' name='add_c'>";
                                }

                            ?>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

    </div>
</body>

</html>