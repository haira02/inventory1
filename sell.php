<?php
    @require_once('initialized.php');
    
    if(!($session->is_logged_in())){
        header("Location: signin.php");
    } 

    $message = '';

    if(isset($_POST['sell'])){
        $record = [];
        $record['date'] = $_POST['date'];
        $record['customer_name'] = $_POST['c_name'];
        $record['invoice_no'] = $_POST['invoice_no'];
        $record['i_code'] = $_POST['item_c'];
        $record['amount'] = $_POST['amount'];
        
        $item = Item::find_by_id($_POST['item_c']);
        if($item->amount < $_POST['amount']){
            $message="There is only {$item->amount} {$item->disc} available!";
        } else {
            $items = Outgoing::find_by_in($record['invoice_no']);
            if($items){
                $message = "There is an invoice with the same number";
            } else {
                $item->amount = $item->amount - $_POST['amount'];
                $item->update();

                if($item->amount < 3){
                    $n_record = [];
                    $n_record['msg'] = "There is a shortage on {$item->disc}!";
                    $n_record['token'] = 0;
                    $notification = Notification::make($n_record);  
                    $notification->create();
                }

                $outgoing = Outgoing::make($record);
                $outgoing->create();
                unset($outgoing);
                $message="Sales Successfully Added!";
            } 
        }
        
    } 

    if(isset($_POST['s_update'])){
        $outgoing = Outgoing::find_by_id($_POST['hidden_id']);

        $outgoing->date = $_POST['date'];
        $outgoing->customer_name = $_POST['c_name'];
        $outgoing->invoice_no = $_POST['invoice_no'];
        $outgoing->i_code = $_POST['item_c'];
        $outgoing->amount = $_POST['amount'];

        $outgoing->update();

        header("Location: outgoing_table.php");
    }

    if (isset($_GET['id'])) {
        $outgoing = Outgoing::find_by_id($_GET['id']);
    }

?>

<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="style/bootstrap.min.css">
    <script type="text/javascript" src="scripts/jquery-1.11.0.min.js"></script>

</head>

<body data-spy="scroll" data-target="navbar" data-offset="50" style="background-color: #EEE;">
    <script type="text/javascript">
        function show(){
            var v = $("#dated").val();
            var details = {id: v};
            $.post("show.php", details, function(data){
                $("#show").html(data);
            });
        };
    </script>
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

                                    if(isset($outgoing)){
                                        echo " value='{$outgoing->date}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="customer">Customer Name</label>
                                <input type="text" class="form-control" id="customer" name="c_name" required=""
                                <?php

                                    if(isset($outgoing)){
                                        echo " value='{$outgoing->customer_name}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div class="form-group">
                                <label for="InvoiceNo">Invoice No.</label>
                                <input type="text" class="form-control" id="Invoiceno" name="invoice_no" required="" 
                                <?php

                                    if(isset($outgoing)){
                                        echo " value='{$outgoing->invoice_no}' ";
                                    } 

                                ?>
                                >
                            </div>
                            <div class="form-group">
                                <label for="InvoiceNo">Item Code</label>
                                <input type="text" class="form-control" onblur="show();" id="dated" required="" >
                            </div>

                            <div id="show">
                                
                            </div>

                            <div class="form-group">
                                <label for="Quantity">Quantity</label>
                                <input type="text" class="form-control" id="Quantity" name="amount" required=""
                                <?php

                                    if(isset($outgoing)){
                                        echo " value='{$outgoing->amount}' ";
                                    } 

                                ?>
                                >
                            </div>

                            <div id="price">
                                
                            </div>

                            <div>
                                <?php

                                    if(isset($outgoing)){
                                        echo "<input type='hidden' name='hidden_id' value='{$outgoing->id}'>";
                                        echo "<input type='submit' name='s_update' value='Update' class='btn btn-default'>";
                                    } else {
                                        echo "<input type='submit' name='sell' value='Sell' class='btn btn-default'>";
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