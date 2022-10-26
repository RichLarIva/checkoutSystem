<?php
    session_start();
//     if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
//         header("location: index.php");
//     }
// ?>
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
                <input type="text" name="barcode" placeholder="BARCODE" required minlength="3" maxlength="15" pattern="[0-9]+" title="Only Numbers are accepted" id="bc">
                <br>
                <span id="best-before"><input type="date" name="bestbefore" required></span>
                <br>
                <input type="submit" name="submit" value="Add Item">
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
    function handleFiles($fileName){
        
        $imgArray = array('image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp', 'image/apng');
        $file = $_FILES[$fileName]['type'];
        switch(true)
        {
            case in_array($file, $imgArray);
                moveFile("images", "Image", $fileName);
                break;

            default:
                echo "<p class='font-weight-bold bg-danger text-warning'> FILE IS NOT SUPPORTED</p>";
                break;
        }
    }
    function moveFile($folder, $fileType, $fileServer){
        $size = $_FILES[$fileServer]["size"];
        $target_dir = "$folder/"; #Gets the folder of where the file should go to allow ease of code
        $file_Name = $_FILES[$fileServer]["name"];
        $fileNa = $_POST["product"];
        $path = pathinfo($file_Name);
        $fileName = $fileNa.$path["filename"];
        $ext = $path['extension'];
        $temp_name = $_FILES[$fileServer]["tmp_name"];
        $path_filename_ext = $target_dir.$fileName.".".$ext;
        $file = $path_filename_ext;
        if(file_exists($path_filename_ext)){
            echo "<p class='font-weight-bold bg-danger text-warning'> Sorry, file already exists!</p>";
        }

        if($size > 5000000){
            echo "<p class='font-weight-bold bg-danger text-warning'> Sorry, this file is to large max file size is 5MB!</p>";
        }

        else{
            move_uploaded_file($temp_name, $path_filename_ext);
            echo "<p class='font-weight-bold bg-success text-white'> Uploading $fileType file!</p>"; 
            # uses the $fileType variable to display the correct file
        }
    }
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
                $sql = "SELECT * FROM product WHERE barcode='$barcode'";
                $res = $conn->query($sql);

                if($res->num_rows == 0){
                    header("location:new-product.php?barcode=".$barcode);
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