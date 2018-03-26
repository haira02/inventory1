<?php
    @require_once('initialized.php');

    $message = '';
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    if(isset($_POST['add_i'])){
        $record = [];
        $record['code'] = $_POST['i_code'];
        $record['disc'] = $_POST['i_disc'];
        $record['category'] = $_POST['cate'];
        $record['amount'] = $_POST['amount'];

        $item = Item::make($record);
        $item->create();
        $message = "Item Successfully Added!";
    }
    if(isset($_POST['update_i'])){
        $item = Item::find_by_id($_POST['hidden_id']);
        $item->code = $_POST['i_code'];
        $item->disc = $_POST['i_disc'];
        $item->category = $_POST['cate'];
        $item->amount = $_POST['amount'];
        $item->price = $_POST['price'];

        $item->update();

        $message = "Item Successfully Updated!";
        header('Location: ./item_table.php');
    }
    if(isset($_GET['id'])){
        $item = Item::find_by_id($_GET['id']);
    } else {
        unset($item);
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

        <div class="container">
            <section>
                <div class="page-header" id="Incoming">
                    <h2>Item List</h2>
                </div>
                <h4 style="color: green;">
                    <?php

                        echo $message;

                    ?>
                </h4> <br />
                <div class="row">
                    <div class="col-sm-3">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="ItemCode">Item Code</label>
                                <input type="text" class="form-control" id="Itemcode" name="i_code" required=""
                                <?php

                                    if(isset($item)){
                                        echo " value='{$item->code}' ";
                                    } 

                                ?>
                                >
                            </div>


                            <div class="form-group">
                                <label for="Itemdesc">Item Description</label>
                                <input type="text" class="form-control" id="Itemdesc" name="i_disc" required=""
                                <?php

                                    if(isset($item)){
                                        echo " value='{$item->disc}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="catagory">Category</label> <br />
                                <select name="cate" style="width: 150px;">
                                    <?php

                                        $cates = Category::find_all();

                                        for ($i=0; $i < count($cates); $i++) { 
                                            echo "<option value='{$cates[$i]->id}'";
                                            if(isset($item)){
                                                if ($item->category == $cates[$i]->id){
                                                    echo " selected ";
                                                }
                                            }
                                            echo ">{$cates[$i]->disc}</option>";
                                        }

                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="qty">Amount</label>
                                <input type="text" class="form-control" id="qty" name="amount" required=""
                                <?php

                                    if(isset($item)){
                                        echo " value='{$item->amount}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div>
                                <?php

                                    if(isset($item)){
                                        echo "<input type='hidden' name='hidden_id' value='{$item->id}' >";
                                        echo "<input type='submit' class='btn btn-default' value='Update' name='update_i'>";
                                    } else {

                                        echo "<input type='submit' class='btn btn-default' value='Add' name='add_i'>";
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