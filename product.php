<?php
    session_start();
    $barcode=$_GET["barcode"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <div class="productView">
            <?php
            require "config.php";
                $sql = "SELECT * FROM product WHERE barcode='$barcode'";
                $result = $conn->query($sql);
                while($prod = mysqli_fetch_assoc($result)){
                    echo "<div class='productInfo'>
                            <img src='".$prod["image"]."' alt='Product Picture'>
                            <h1>".$prod["name"]."</h1>
                        <p>".$prod["descr"]."</p> 
                        <hr>
                        <span> Category: ".$prod["category"]."</span>
                    </div>";
                }
            ?>
        </div>
    </div>

<?php
    include "footer.php";
?>