<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="productHolder">
        
    <?php
    require "config.php";
        $sql = "SELECT * FROM product";
        $result = $conn->query($sql);
        while($prod = mysqli_fetch_assoc($result)){
            echo "<div class='product'><img src='".$prod["image"]."' alt='Product Picture'><hr><h1>".$prod["name"]."</h1><p>".$prod["descr"]."</p> <br><button onclick='getBarCode(".$prod["barcode"].")'>Get The Barcode</button> <span> Category: ".$prod["category"]."</span></div>";
        }

    ?>

</div>
    <form method="POST" action="#" class="productReg">
        <input type="text" name="barcode" placeholder="BARCODE" required minlength="3" maxlength="15" pattern="[0-9]+" title="Only Numbers are accepted" id="bc">
        <br>
        <span id="best-before"><input type="date" name="bestbefore" required></span>
        <br>
        <input type="submit" name="submit" value="Add Item">
    </form>
    <?php
        if(isset($_POST["submit"])){
            require "config.php";
            $barcode = $_POST["barcode"];
            $bfDate = $_POST["bestbefore"];
            $sql = "SELECT * FROM product WHERE barcode='$barcode'";
            $res = $conn->query($sql);
            if($res->num_rows == 0){
                header("location: new-product.php?barcode=".$barcode);
            }
            else{
                $sql = "INSERT INTO item (best_before, barcode) VALUES(?, ?)";
                if($stmt = $conn->prepare($sql)){
                    $stmt->bind_param("ss", $bfDate, $barcode);
                    if($stmt->execute()){
                        $query = "SELECT COUNT(*) as amount FROM item WHERE barcode='$barcode'";
                        $res = $conn->query($query);
                        $data = mysqli_fetch_assoc($res);
                        $amount = $data['amount'];
                        $sql = "UPDATE product SET amount = ? WHERE barcode = '$barcode'";
                        if($stmt = $conn->prepare($sql)){
                            $stmt->bind_param("i", $amount);
                            if($stmt->execute()){
                                header("location: index.php");
                            }
                        }
                    }
                }
                $stmt->close();
            }
            $conn->close();
        }
    ?>
    <script src="js/productReg.js"></script>
</body>
</html>