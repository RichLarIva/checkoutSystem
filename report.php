<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">

        <div class="flexreport">
            <div class="reportbox">
                <h1>Daily Report</h1>

                <h2>Products Sold: </h2>
                <table class="orderTable">
                    <thead>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Price</th>
                    </thead>
                    <?php
                        require "config.php";
                        $sql = "SELECT * FROM orders";
                        $res = $conn->query($sql);
                        $today = date("Y-m-d");
                        while($resu = mysqli_fetch_assoc($res)){
                            $sql = "SELECT * FROM order_item WHERE order_id = '".$resu["order_id"]."'";
                            $re = $conn->query($sql);
                            while($us = mysqli_fetch_assoc($re)){
                                if(date("Y-m-d", strtotime($resu['order_date'])) == date("Y-m-d", strtotime($today))){
                                echo "<tr> <td>".$us['item_name']."</td><td>".$us['item_qty']."</td><td>".date("Y-m-d", strtotime($resu['order_date']))."</td><td>".$us['item_price']."</td>";
                                }
                                echo "<tr>";
                            }
                        }

                    ?>
                </table>

                <h1 class="daily-cash">Cash payments: </h1><?php 
                require "config.php";
                $sql = "SELECT order_total, order_date FROM orders WHERE pay_type=1";
                $res = $conn->query($sql);
                
                $total = 0.00;
                while($resu = mysqli_fetch_assoc($res)){
                    if(date("Y-m-d", strtotime($resu['order_date'])) == date("Y-m-d", strtotime($today))){
                        $total += $resu['order_total'] ;
                    }
                }
                echo "<p> $total:- </p>";
                ?>
                <h1 class="daily-swish"> Swish Payments:</h1>
                <?php 

                $sql = "SELECT order_total, order_date FROM orders WHERE pay_type=0";
                $res = $conn->query($sql);
                $total = 0.00;
                while($resu = mysqli_fetch_assoc($res)){
                    if(date("Y-m-d", strtotime($resu['order_date'])) == date("Y-m-d", strtotime($today))){
                        $total += $resu['order_total'] ;
                    }
                }
                echo "<p> $total:- </p>";
                ?>
                <h1 class="daily-sum">Total sales: </h1>
                <?php 

                $sql = "SELECT order_total, order_date FROM orders";
                $res = $conn->query($sql);
                $total = 0.00;
                while($resu = mysqli_fetch_assoc($res)){
                    if(date("Y-m-d", strtotime($resu['order_date'])) == date("Y-m-d", strtotime($today))){
                        $total += $resu['order_total'] ;
                    }
                }
                echo "<p> $total:-</p>";
                ?>
            </div>

            <div class="reportbox">
                <h1>Monthly Report</h1>

                <h2>Products Sold: </h2>
                <table class="orderTable">
                    <thead>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Price</th>
                    </thead>
                    <?php
                        require "config.php";
                        $sql = "SELECT * FROM orders";
                        $res = $conn->query($sql);
                        while($resu = mysqli_fetch_assoc($res)){
                            $sql = "SELECT * FROM order_item WHERE order_id = '".$resu["order_id"]."'";
                            $re = $conn->query($sql);
                            while($us = mysqli_fetch_assoc($re)){
                                if(date("Y-m", strtotime($resu['order_date'])) == date("Y-m", strtotime($today))){
                                echo "<tr> <td>".$us['item_name']."</td><td>".$us['item_qty']."</td><td>".date("Y-m-d", strtotime($resu['order_date']))."</td><td>".$us['item_price']."</td>";
                                }
                                echo "<tr>";
                            }
                        }

                    ?>
                </table>

                <h1 class="monthly-cash">Cash payments:</h1>
                <?php 

                $sql = "SELECT order_total, order_date FROM orders WHERE pay_type=1";
                $res = $conn->query($sql);
                $total = 0.00;
                while($resu = mysqli_fetch_assoc($res)){
                    if(date("Y-m", strtotime($resu['order_date'])) == date("Y-m", strtotime($today))){
                        $total += $resu['order_total'] ;
                    }
                }
                echo "<p> $total:- </p>";
                ?>
                <h1 class="monthly-swish"> Swish Payments:</h1>
                <?php 

                $sql = "SELECT order_total, order_date FROM orders WHERE pay_type=0";
                $res = $conn->query($sql);
                $total = 0.00;
                while($resu = mysqli_fetch_assoc($res)){
                    if(date("Y-m", strtotime($resu['order_date'])) == date("Y-m", strtotime($today))){
                        $total += $resu['order_total'] ;
                    }
                }
                echo "<p> $total:- </p>";
                ?>
                <h1 class="monthly-sum">Total sales: </h1>
                <?php 

                $sql = "SELECT order_total, order_date FROM orders";
                $res = $conn->query($sql);
                $total = 0.00;
                while($resu = mysqli_fetch_assoc($res)){
                    if(date("Y-m", strtotime($resu['order_date'])) == date("Y-m", strtotime($today))){
                        $total += $resu['order_total'] ;
                    }
                }
                echo "<p> $total:- </p>";
                $conn->close();
                ?>
            </div>
        </div>

    </div>
<?php include "footer.php"; ?>
</body>
</html>