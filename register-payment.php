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
    <link rel="stylesheet" href="css/payment.css">
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
    <script src="js/payment.js"></script>
    <?php
        include "navbar.php";
    ?>

    <br>  
    <div class="container">
    <div id="checkout">

        <div id="productview">
            <div class="productpre">

                <img class="prodpreimg" src="images/Kexchoklad.jpeg" alt="e">

                <div class="prodinfo">
                    <div class="prodname"><p class="pname">Product</p></div>

                    <div class="prodremove"><button class="fa-solid fa-x"></button></div>

                    <div class="prodprice"><p class="pprice">Price</p></div>

                    <div class="prodamount">
                        <div class="amountbtn"><button class="abtn">+</button></div>
                        <div class="pamount"><p>0</p></div>
                        <div class="amountbtn"><button class="abtn">-</button></div>
                    </div>
                </div>
            </div>
            
        </div>

        <div id="mone">

            <div class="moneinfo"><p>Total:</p><p id="mtottal"></p></div>

            <div class="moneinfo"><p>Cash:</p><p id="mcash"></p></div>

            <div class="moneinfo"><p>Return:</p><p id="mreturn"></p></div>

        </div>

        <div id="checkoutbtn"><button id="checkbtn" onclick="addProduct()">Checkout</button></div>

    </div>
        <?php
        include "livesearch.html";

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


        <div>
            <form action="#" method="POST">
                <input type="radio" name="payment" value="0" id="swish">
                <label for="swish">Swish payment</label>
                <br>
                <input type="radio" name="payment" value="1" required id="cash">
                <label for="cash">Cash payment</label>
                <br>
                <input type="submit" name="submit" value="Confirm Payment">
            </form>
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

<?php
    include "footer.php";
?>