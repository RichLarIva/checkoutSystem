<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
</head>
<body>

    <?php include 'navbar.php'; ?>
        
    <div class="container">
        <table class="inv-table">
            <thead>
                <th>Product</th>
                <th>ID</th>
                <th>Best Before</th>
                <th>Barcode</th>
            </thead>
        <?php
            require "config.php";
            $q = "SELECT * FROM item WHERE bought='0'";
            $res = $conn->query($q);
            while($item = mysqli_fetch_assoc($res)){
                $query = "SELECT * FROM product WHERE barcode='".$item["barcode"]."'";
                $result = $conn->query($query);
                while($prod = mysqli_fetch_assoc($result)){
                    echo "<tr> <td>".$prod["name"]."</td> <td>".$item["id"]."</td> <td>".$item["best_before"]."</td> <td>".$item["barcode"]."</td></tr>";

                }
            }
        ?>
        </table>
    </div>
    
    <?php
    include "footer.php";
?>