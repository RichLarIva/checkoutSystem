<?php
    session_start();
    include "pub-funcs.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register payment</title>
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="css/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            var xmlhttp=new XMLHttpRequest();

            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch").innerHTML=this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }

            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
        }
</script>
</head>
<body>
    <?php
        include "navbar.php";
    ?>

    <br>  
    <div class="container">
        
    <div id="checkout">

        <div id="productview">
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
                        echo "<div class='productpre'>
                                <img src='".$prod['image']."' class='prodpreimg' alt='Product Image'> 
                                <div class='prodinfo'>
                                <div class='prodname'><p class='pname'>".$prod['name']."</p></div>
                                <div class='prodprice'><span class='pprice'>".(float)$prod['price'].":- </span></div>
                                <div class='prodamount'> <span class='pamount'>Amount:".(int)$prodsInCart[$prod['name']]."</span></div>
                                </div>
                            </div>";
                        $subtotal += (float)$prod["price"] * (int)$prodsInCart[$prod['name']];
                    }
                }

            ?>
            
        </div>

        <div id="mone">

            <div class="moneinfo"><?php
            echo "<p>Total:</p>
                <p id='mtottal'>$subtotal</p></div>";
            ?>

        </div>


    </div>
    <div class="flex prods">
        <?php
            getAllProducts();
        ?>
        </div>
        <br><br>
        <?php
        include "livesearch.html";
        ?>

    <br><br><br>
        <div>
            <form action="#" method="POST">
                <input type="radio" name="payment" value="0" id="swish">
                <label for="swish">Swish payment</label>
                <br>
                <input type="radio" name="payment" value="1" required id="cash">
                <label for="cash">Cash payment</label>
                <br>
                <br>
                <?php 
                echo '<input type="number" disabled id="cashGet" min="'.round($subtotal).'" max="999999999999" placeholder="0" >';
                ?>
                <br>
                <p id="return"></p>
                <br>
                <br>
                <input type="submit" name="submit" value="Confirm Payment">
            </form>
            <button onclick="getAmount()">Get Cash Return</button>
        </div>

            
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

    <script src="js/exchangeSystem.js"></script>
    <script src="js/purchaseHandler.js"></script>
<?php
    include "footer.php";
?>