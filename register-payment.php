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
            $prodsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
            $prods = array();
            $subtotal = 0.00;
            var_dump($_SESSION['cart']);
            if($prodsInCart){
                foreach($prods as $prod){
                    var_dump($_SESSION['cart']);
                    echo $subtotal;
                }
            }
        ?>
        <form action="#" method="POST">
            <input type="submit" name="submit">
        </form>
    <?php
    
    if(isset($_POST["submit"]) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        $name = $_POST["itemName"];
        $sql = "SELECT * FROM product WHERE name = '$name'";
        $qty = $_POST["qty"];
        $res = $conn->query($sql);
        $pro = mysqli_fetch_assoc($res);
        $itemID = $pro["id"];
        $itemPrice = $pro["price"];
        $price =  $qty * $itemPrice;
        $conn->query("INSERT INTO orders (order_total) VALUES('$price')");
        $id = $conn->insert_id;
        $sql = "INSERT INTO order_item (order_id, item_id, item_name, item_qty, item_price) VALUES($id, $itemID, '$name', $qty, $itemPrice)";
        if($conn->query($sql) === TRUE){
            echo "HEY";
        }
        
    }

    ?>
    </div>

<?php
    include "footer.php";
?>