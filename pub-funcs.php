<?php
    # Function returns a string where breaks between paragraphs within a textarea/input text becomes a <br> in html
    function mynl2br($text) { 
        return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />')); 
    }
     
    function handleFiles($fileName){
        
        $imgArray = array('image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp', 'image/apng');
        $file = $_FILES[$fileName]['type'];

        switch(true){
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

    function post_products($type){
        require "config.php";
            if($type != "all"){
                $sql = "SELECT * FROM product WHERE     category = '".$type."'";
                $result = $conn->query($sql);

                while($product = mysqli_fetch_assoc ($result)){
                    echo "<div class='produkt'> 
                        <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                            <h3 class='produktnamn'>".$product["name"]."</h3>
                            <h4 class='produktpris'>".$product["price"].":-</h4>
                            <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                            <a class='productLink' href='product.php?barcode=".$product["barcode"]."'>Info</a>
                            <a class='add-to-cart' href='#' data-name='".$product["name"]."' data-price='".$product['price']."' data-imgURL='".$product["image"]."'>Add to Cart</a>
                    </div>";
                }
            }
            else if($type == "all" || $type === "all"){
                $sql = "SELECT * FROM product ORDER BY category";
                $result = $conn->query($sql);

                while($product = mysqli_fetch_assoc ($result)){
                    echo "<div class='produkt'> 
                        <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                            <h3 class='produktnamn'>".$product["name"]."</h3>
                            <h4 class='produktpris'>".$product["price"].":-</h4>
                            <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                            <a class='productLink' href='product.php?barcode=".$product["barcode"]."'>Info</a>
                            <a class='add-to-cart' href='#' data-name='".$product["name"]."' data-price='".$product['price']."' data-imgURL='".$product["image"]."'>Add to Cart</a>
                            <br>
                            <p class='categoryOfItem'>".$product["category"]."</p>
                    </div>";
                }
            }
    }
    
    function getAllProducts(){
        require "config.php";
        $sql = "SELECT * FROM product ORDER BY category";
                $result = $conn->query($sql);

                while($product = mysqli_fetch_assoc ($result)){
                    echo "<div class='produkt'> 
                        <img class='produktbild' src='".$product["image"]."' alt='Product Picture'>
                            <h3 class='produktnamn'>".$product["name"]."</h3>
                            <h4 class='produktpris'>".$product["price"].":-</h4>
                            <h3 class='produktantal'>Stock: ".$product["amount"]."</h3>
                            <br>
                            <a class='add-to-cart' href='addToCart.php?name=".$product['name']."'>Add to Cart</a>
                            <p class='categoryOfItem'>".$product["category"]."</p>
                    </div>";
                }
    }

    function checkIfNotUnique($conn, $currentChecking){
        global $shoudAccountCreate;
        if(isset($_POST['reg'])){
            $res = mysqli_query($conn, 
                "SELECT * FROM Accounts WHERE $currentChecking='" . $_POST[$currentChecking] . "'"
            );
            if(mysqli_num_rows($res) > 0){
                echo ucfirst($currentChecking . " needs to be unique.");
                $shoudAccountCreate = false;
            }
        }
    }


?>