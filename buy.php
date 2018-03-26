<?php
    @require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    $message = '';

    if(isset($_POST['buy'])){
        $record = [];
        $record['date'] = $_POST['date'];
        $record['customer_name'] = $_POST['c_name'];
        $record['invoice_no'] = $_POST['invoice_no'];
        $record['i_code'] = $_POST['item_c'];
        $record['amount'] = $_POST['amount'];
        $record['price'] = $_POST['price'];
        
        $item = Item::find_by_id($_POST['item_c']);
        $item->amount = $item->amount + $_POST['amount'];
        $item->price = $record['price'];
        $item->update();

        $outgoing = Incoming::make($record);
        $outgoing->create();
        unset($Outgoing);
        $message="Sales Successfully Added!";

    }

    if(isset($_POST['b_update'])){
        $incoming = Incoming::find_by_id($_POST['hidden_id']);
        $incoming->date = $_POST['date'];
        $incoming->customer_name = $_POST['c_name'];
        $incoming->invoice_no = $_POST['invoice_no'];
        $incoming->i_code = $_POST['item_c'];
        $incoming->amount = $_POST['amount'];
        $incoming->price = $_POST['price'];
        echo $incoming->amount;
        $incoming->update();
        header("Location: incoming_table.php");
    }

    if(isset($_GET['id'])){
        $incoming = Incoming::find_by_id($_GET['id']);
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
                <div class="page-header" id="Outgoing">
                    <h2>Sales</h2>
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
                                <label for="Date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required="" 
                                <?php

                                    if(isset($incoming)){
                                        echo " value='{$incoming->date}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="customer">Customer Name</label>
                                <input type="text" class="form-control" id="customer" name="c_name" required=""
                                <?php

                                    if(isset($incoming)){
                                        echo " value='{$incoming->customer_name}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="InvoiceNo">Invoice No.</label>
                                <input type="text" class="form-control" id="Invoiceno" name="invoice_no" required=""
                                <?php

                                    if(isset($incoming)){
                                        echo " value='{$incoming->invoice_no}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="ItemCode">Item Code</label><br />
                                <select name="item_c" style="width: 150px;">
                                    <?php

                                        $item_c = Item::find_all();

                                        for ($i=0; $i < count($item_c); $i++) { 
                                            echo "<option value='{$item_c[$i]->id}'";
                                            if (isset($incoming)) {
                                                if($item_c[$i]->id == $incoming->i_code){
                                                    echo " selected ";
                                                }
                                            }
                                            echo ">{$item_c[$i]->disc}</option>";
                                        }

                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Quantity">Quantity</label>
                                <input type="text" class="form-control" id="Quantity" name="amount" required=""
                                <?php

                                    if(isset($incoming)){
                                        echo " value='{$incoming->amount}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="Total">Price</label>
                                <input type="text" class="form-control" id="Total" name="price" required=""
                                <?php

                                    if(isset($incoming)){
                                        echo " value='{$incoming->price}' ";
                                    } 

                                ?>
                                > 
                            </div>

                            <div>
                                <?php

                                    if(isset($incoming)){
                                        echo "<input type='hidden' name='hidden_id' value='{$incoming->id}'>";
                                        echo "<input type='submit' name='b_update' value='Update' class='btn btn-default'>";
                                    } else {
                                        echo "<input type='submit' name='buy' value='Buy' class='btn btn-default'>";
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