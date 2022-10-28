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
                $prod = mysqli_fetch_assoc($result);
                    echo "<div class='productInfo'>
                            <img src='".$prod["image"]."' alt='Product Picture'>
                            <div class='productflexbox'>
                                <h1>".$prod["name"]."</h1>
                                <hr>
                                <p>".$prod["descr"]."</p> 
                                <span> Category: ".$prod["category"]."</span>";
                                if($prod["amount"] != 0){
                                    echo "<form method='post' action='#'>
                                    <input type='number' name='qty' value='1' min='1' max='".$prod['amount']."' placeholder='Quantity' required>
                                    <input type='submit' value='Add to cart' name='AddtoCart'>
                                </form>";
                                }
                                echo "
                            </div>
                    </div>";

                if(isset($_POST["AddtoCart"])){
                    $name = $prod["name"];
                    $qty = (int)$_POST["qty"];
                    if($qty > 0){
                        if(isset($_SESSION["cart"]) && is_array($_SESSION['cart'])){
                            if(array_key_exists($name, $_SESSION['cart'])){
                                $_SESSION['cart'][$name] += $qty;
                            }
                            else{
                                $_SESSION['cart'][$name] = $qty;
                            }
                        }
                        else{
                            # No products in cart, this will add the first product to cart
                            $_SESSION['cart'] = array($name => $qty);
                        }
                    }

                }
            ?>
        </div>
    </div>

<?php
    include "footer.php";
?>