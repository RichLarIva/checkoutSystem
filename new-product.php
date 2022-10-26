<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New product</title>
</head>
<body>

    <?php include 'navbar.php'; ?>
    <div class="container">

        <br>
        <form method="POST" enctype="multipart/form-data" class="productReg">
            <input type="text" name="price" placeholder="Price" required minlength="1" maxlength="13" pattern="[0-9]+([.][0-9]+)?" title="Only Numbers and the decimal point is Allowed.">
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
                $barcode = $_GET["barcode"];

                if(isset($_POST["addNewPro"])){
                    $price = $_POST["price"];
                    $name = $_POST["product"];
                    $desc = mynl2br($_POST["description"]);
                    $cat = $_POST["category"];
                    $file = 'images/'.$name.$_FILES["image"]["name"];
                    if($stmt = $conn->prepare("INSERT INTO product (price, amount, name, image, descr, category, barcode) VALUES (?, 0, ?, ?, ?, ?, ?)")){
                        $stmt->bind_param("dsssss", $price, $name, $file, $desc, $cat, $barcode);
                        if($stmt->execute()){
                            header("location: register-product.php");
                        }
                    }
                    $stmt->close();
                    $conn->close();
                }
            ?>
        </div>

        <?php
    include "footer.php";
?>