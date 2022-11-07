<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register payment</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    <div class="container">
        <?php
        require "config.php";
            $prodsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            $prods = array();
            $subtotal = 0.00;
            $keys = array_keys($prodsInCart);
            foreach($keys as $key){
                $res = $conn->query("SELECT * FROM product WHERE name='$key'");
                if($prodsInCart){
                    $prod = mysqli_fetch_assoc($res);
                    echo "<div class='orderProd'>
                            <img src='".$prod['image']."' alt='Product Image'> 
                            <h2>".$prod['name']."<h2>
                            <span>".(float)$prod['price'].":- </span>
                            <span>Amount: ".(int)$prodsInCart[$prod['name']]."</span>
                        </div>";
                    $subtotal += (float)$prod["price"] * (int)$prodsInCart[$prod['name']];
                    
                }
            }
                echo "$subtotal:-";
        ?>
        <form action="#" method="POST">
            <input type="radio" name="payment" value="0" id="swish">
            <label for="swish">Swish payment</label>
            <br>
            <input type="radio" name="payment" value="1" required id="cash">
            <label for="cash">Cash payment</label>
            <br>
            <input type="submit" name="submit">
        </form>
    <?php
    
    if(isset($_POST["submit"]) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        $payType = $_POST["payment"];
        $conn->query("INSERT INTO orders (order_total, pay_type) VALUES('$subtotal', $payType)");
        $id = $conn->insert_id;
        foreach($keys as $key){
            $sql = "SELECT * FROM product WHERE name = '$key'";
            $res = $conn->query($sql);
            $pro = mysqli_fetch_assoc($res);
            $itemPrice = $pro["price"];
            $itemID = $pro["id"];
            $sql = "INSERT INTO order_item (order_id, item_id, item_name, item_qty, item_price) VALUES($id, $itemID, '$key', '".(int)$prodsInCart[$prod['name']]."', $itemPrice)";
            if($conn->query($sql) === TRUE){
                $sqlt = "SELECT amount, barcode FROM product WHERE name='$key'";
                $res = $conn->query($sqlt);
                $re = mysqli_fetch_assoc($res);
                $am = $re["amount"] - (int)$prodsInCart[$prod['name']];
                $barcode = $re['barcode'];
                $i = 0;
                while ($i != (int)$prodsInCart[$prod['name']])
                {
                    $q = "SELECT * FROM `item` WHERE barcode='$barcode' AND bought='0' ORDER BY best_before;";
                    $result = $conn->query($q);
                    $values = mysqli_fetch_assoc($result);
                    $itID = $values['id'];
                    echo $itID;
                    $qup = "UPDATE item set bought='1' WHERE id='$itID'";
                    $conn->query($qup);
                    $i++;
                }
                    if($stmt = $conn->prepare($sql)){
                        
                    $sql = "UPDATE product SET amount = ? WHERE name = '$key'";
                    
                    if($stmt = $conn->prepare($sql)){
                        if($am <= 0){
                            $am = 0;
                        }
                        $stmt->bind_param("i", $am);
                        if($stmt->execute()){
                            unset($_SESSION['cart']);
                            header("location: index.php");
                        }
                        
                    }
                }
            }
            else{
                echo "There was an error placing your order";
            }
        }
        
    }

    ?>
    </div>

<?php
    include "footer.php";
?>