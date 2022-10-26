<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<div class="productHolder">
            <?php
                require "config.php";
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);
                while($prod = mysqli_fetch_assoc($result)){
                    echo "<div class='regprod'><img class='regprodimg' src='".$prod["image"]."' alt='Product Picture'><hr><h1 class='regprodname'>".$prod["name"]."</h1><p>".$prod["descr"]."</p> <br><button onclick='getBarCode(".$prod["barcode"].")'>Get The Barcode</button> <span> Category: ".$prod["category"]."</span></div>";
                }
                $conn->close();
            ?>
        </div>

        </body>
</html>