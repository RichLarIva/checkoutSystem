<?php
    session_start();
     if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
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
<?php 

    include 'navbar.php'; ?>
    <div class="container">

    <div class="productHolder">
            <?php
                require "config.php";

                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);

                while($prod = mysqli_fetch_assoc($result)){
                    echo "<div class='regprod'><img class='regprodimg' src='".$prod["image"]."' alt='Product Picture'><hr><h1 class='regprodname'>".$prod["name"]."</h1><p class='regproductdesc'>".$prod["descr"]."</p> <br><button onclick='getBarCode(".$prod["barcode"].")'>Get The Barcode</button> <span> Category: ".$prod["category"]."</span></div>";
                }

                $conn->close();
            ?>
        </div>
        
        <div class="tab">
            <button onclick="openTab(event, 'RegProd')" class="tablinks active" id="defaultOpen">Add Product</button>
            <button onclick="openTab(event, 'AddProd')" class="tablinks">Register New Product</button>
        </div>

        <div id="RegProd" class="tabcontent">
            <form method="POST" class="productReg">
                <input type="text" name="barcode" placeholder="BARCODE" required minlength="3" maxlength="15" pattern="[0-9]+" title="Only Numbers are accepted" id="bc" class="reginput">
                <br>
                <div class="reginputbox">
                    <span id="expDate"><input type="date" name="bestbefore" required id="add-date" class="reginput"></span>
                </div>
                <br>
                <div class="reginputbox">
                    <span id="amountSpan"><input type="number" value="1" min="1" max="999" name="amountProd" class="reginput"></span>
                </div>
                <br>
                <input type="submit" name="submit" value="Add Item" id="add-submit" class="reginput">
            </form>
        </div>
            

<br>
<div id="AddProd"  class="tabcontent active">

    <form method="POST" enctype="multipart/form-data" class="productReg">
        <input type="text" name="price" placeholder="Price" required minlength="1" maxlength="13" pattern="[0-9]+([.][0-9]+)?" title="Only Numbers and the decimal point is Allowed.">
        <input type="text" name="barcod" placeholder="BARCODE" required minlength="3" maxlength="15" pattern="[0-9]+" title="Only Numbers are accepted">
        <br>
        <input type="text" name="product" placeholder="Name of product" required>
        <br>
        <input type="file" name="image" required>
        <br>
        <textarea name="description" required></textarea>
        <br>
        <select name="category" required>
            <option value="chips">Chips</option>
            <option value="candy">Candy</option>
            <option value="fruit">Fruit</option>
            <option value="drinks">Drinks</option>
            <option value="cookies">Cookies</option>
        </select>
        <br>
        <input type="submit" name="addNewPro" value="Add new Product">
    </form>
</div>

<?php
    require "config.php";
    include "pub-funcs.php";
    if(isset($_FILES['image']) && $_FILES['file']['error'] == 0)
    {
        handleFiles('image');
    }
        if(isset($_POST["addNewPro"])){
            $price = $_POST["price"];
            $name = $_POST["product"];
            $desc = mynl2br($_POST["description"]);
            $cat = $_POST["category"];
            $barcode = $_POST["barcod"];
            $file = 'images/'.$name.$_FILES["image"]["name"];
            if($stmt = $conn->prepare("INSERT INTO product (price, amount, name, image, descr, category, barcode) VALUES (?, 0, ?, ?, ?, ?, ?)")){
                $stmt->bind_param("dsssss", $price, $name, $file, $desc, $cat, $barcode);
                if($stmt->execute()){
                    header("location: index.php");
                }
            }
            $stmt->close();
            $conn->close();
        }
    ?>
</div>


        <?php
            if(isset($_POST["submit"])){
                require "config.php";

                $barcode = $_POST["barcode"];
                $bfDate = $_POST["bestbefore"];
                $amnt = $_POST["amountProd"];
                $sql = "SELECT * FROM product WHERE barcode='$barcode'";
                $res = $conn->query($sql);

                if($res->num_rows == 0){
                    echo "Item doesn't exist";
                }

                else{
                            if($amnt == 1){
                                $sql = "INSERT INTO item (best_before, barcode) VALUES(?, ?)";

                                if($stmt = $conn->prepare($sql)){
                                    $stmt->bind_param("ss", $bfDate, $barcode);

                                    if($stmt->execute()){
                                        header("location: index.php");
                                    }
                                }
                            }
                            
                        
                    else{
                        $i = 0;
                        while($i < $amnt){
                            $sql = "INSERT INTO item (best_before, barcode) VALUES(?, ?)";
                                if($stmt = $conn->prepare($sql)){
                                    $stmt->bind_param("ss", $bfDate, $barcode);
                                    if($stmt->execute()){
                                        
                                        $i++;
                                    }
                                }
                            }
                    
                    }
                    $query = "SELECT COUNT(*) as amount FROM item WHERE barcode='$barcode' AND bought='0'";
                        $res = $conn->query($query);
                        $data = mysqli_fetch_assoc($res);
                        $amount = $data['amount'];
                        $sql = "UPDATE product SET amount = ? WHERE barcode = '$barcode'";
                        if($stmt = $conn->prepare($sql)){
                            $stmt->bind_param("i", $amount);
                            $stmt->execute();
                        }
                    $stmt->close();
                }
                $conn->close();
            }
        ?>

        <script src="js/productReg.js"></script>

    </div>

    <script>

        function openTab(evt, category) {
            // Declare all variables
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            document.getElementById(category).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>
    <?php include "footer.php"; ?>