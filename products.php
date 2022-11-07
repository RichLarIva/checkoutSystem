    <div class="productHolder">
        <?php
                require "config.php";
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);
                while($prod = mysqli_fetch_assoc($result)){
                    echo "<div class='regprod'><img class='regprodimg' src='".$prod["image"]."' alt='Product Picture'><hr><h1 class='regprodname'>".$prod["name"]."</h1><p>".$prod["descr"]."</p> <br> <span> Category: ".$prod["category"]."</span></div>";
                }
                $conn->close();
                ?>
        </div>
    </div>