<?php

    session_start();
    require "config.php";
    $name=$_GET["name"];
    $sql = "SELECT * FROM product WHERE name='$name'";
    $result = $conn->query($sql);
    $prod = mysqli_fetch_assoc($result);
    $name = $prod["name"];
    $qty = 1;
    $amount = $prod["amount"];
    if(!($amount < $qty)){

        if($qty > 0){
            if(isset($_SESSION["cart"]) && is_array($_SESSION['cart'])){
                if(array_key_exists($name, $_SESSION['cart'])){
                    $_SESSION['cart'][$name] += $qty;
                    header("location: register-payment.php");
                }
                else{
                    $_SESSION['cart'][$name] = $qty;
                    header("location: register-payment.php");
                }
            }
            else{
                # No products in cart, this will add the first product to cart
                $_SESSION['cart'] = array($name => $qty);
                header("location: register-payment.php");
            }
        }
    }
    else{
        header("location: register-payment.php");
    }
?>