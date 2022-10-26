<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Butik</title>
</head>
<body onload="document.getElementById('defaultOpen').click();">

    <?php include 'navbar.php'; ?>
    <div class="container">


    <div class="tab">
        <button onclick="openTab(event, 'Godis')" class="tablinks active" id="defaultOpen">Godis</button>
        <button onclick="openTab(event, 'Chips')" class="tablinks">Chips</button>
        <button onclick="openTab(event, 'Dryck')" class="tablinks">Dryck</button>
        <button onclick="openTab(event, 'Frukt')" class="tablinks">Frukt</button>
        <button onclick="openTab(event, 'Kakor')" class="tablinks">Kakor</button>
    </div>

    <div id="Godis" class="tabcontent">
        <div class="flex-lager">
        <?php
            require "config.php";
            $sql = "SELECT * FROM product WHERE category = 'candy'";
            $result = $conn->query($sql);
            while($product = mysqli_fetch_assoc($result)){
                echo "<div class='produkt'> 
                    <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                    <div class='produktinfo'>
                        <h3 class='produktnamn'>".$product["name"]."</h3>
                        <h4 class='produktpris'>".$product["price"].":-</h4>
                    </div>
                    <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                    <hr>
                    <a class='productLink' href='product.php?barcode=".$product["barcode"]."'>Info</a>
                    <button class='update'>Update</button>
                    </div>";
            }
        ?>
        </div>
    </div>

    <div id="Chips" class="tabcontent">
        <div class="flex-lager">
        <?php
            require "config.php";
            $sql = "SELECT * FROM product WHERE category = 'chips'";
            $result = $conn->query($sql);
            while($product = mysqli_fetch_assoc($result)){
                echo "<div class='produkt'> 
                    <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                    <div class='produktinfo'>
                        <h3 class='produktnamn'>".$product["name"]."</h3>
                        <h4 class='produktpris'>".$product["price"].":-</h4>
                    </div>
                    <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                    <hr>
                    <a class='productLink' href='product.php?barcode=".$product["barcode"]."'>Info</a>
                    <button class='update'>Update</button>
                    </div>";
            }
        ?>
        </div>  
    </div>

    <div id="Dryck" class="tabcontent">
        <div class="flex-lager">
        <?php
            require "config.php";
            $sql = "SELECT * FROM product WHERE category = 'drinks'";
            $result = $conn->query($sql);
            while($product = mysqli_fetch_assoc($result)){
                echo "<div class='produkt'> 
                    <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                    <div class='produktinfo'>
                        <h3 class='produktnamn'>".$product["name"]."</h3>
                        <h4 class='produktpris'>".$product["price"].":-</h4>
                    </div>
                    <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                    <hr>
                    <a class='productLink' href='product.php?barcode=".$product["barcode"]."'>Info</a>
                    <button class='update'>Update</button>
                    </div>";
            }
        ?>
        </div>    
    </div>

    <div id="Frukt" class="tabcontent">
        <div class="flex-lager">
        <?php
            require "config.php";
            $sql = "SELECT * FROM product WHERE category = 'fruit'";
            $result = $conn->query($sql);
            while($product = mysqli_fetch_assoc($result)){
                echo "<div class='produkt'> 
                    <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                    <div class='produktinfo'>
                        <h3 class='produktnamn'>".$product["name"]."</h3>
                        <h4 class='produktpris'>".$product["price"].":-</h4>
                    </div>
                    <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                    <hr>
                    <a class='productLink' href='product.php?barcode=".$product["barcode"]."'>Info</a>
                    <button class='update'>Update</button>
                    </div>";
            }
        ?>
        </div>    
    </div>

    <div id="Kakor" class="tabcontent">
        <div class="flex-lager">
        <?php
            require "config.php";
            $sql = "SELECT * FROM product WHERE category = 'cookies'";
            $result = $conn->query($sql);
            while($product = mysqli_fetch_assoc($result)){
                echo "<div class='produkt'> 
                    <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                    <div class='produktinfo'>
                        <h3 class='produktnamn'>".$product["name"]."</h3>
                        <h4 class='produktpris'>".$product["price"].":-</h4>
                    </div>
                    <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                    <hr>
                    <p class='productDesc'>".$product["descr"]."</p>
                    <button class='update'>Update</button>
                    </div>";
            }
            $conn->close();
        ?>
        </div>
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

    </div>



  


</body>
</html>