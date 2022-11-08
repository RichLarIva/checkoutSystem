<?php
    session_start();
?>

<div class="hor-navbar">
    <div class="hor-navbar1">
        <div id="brandMenu">
            <!-- <button id="menuOpen" class="btn-menu"><i class="fas fa-bars"></i></button> -->
            <div id="brand" onclick="window.location.href='index.php'">
                <img src="https://www.freeiconspng.com/thumbs/gear-icon/gear-icon-13.png" alt="Account Manager Logo" class="nav-logo">
            
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link rel="stylesheet" href="css/index.css">
                <h1 class="nav-h1">Butik manager</h1>
            
            </div>    
        </div> 

        <div class="hor-btnbox">
            <div class="hor-loginbox hor-btn" onclick="window.location='login.php'">
                <p class="hor-loginname"><?php if(isset($_SESSION)) echo $_SESSION['username']; ?></p>
                <a class="hor-btn" href="login.php"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a>
            </div>

            <a class="hor-btn hor-cartbtn" href="register-payment.php"><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="hor-navbar2">
        <a class="nav2-a" href="orders.php">Orders</a>
        <a class="nav2-a" href="inventory.php">Inventory</a>
        <a class="nav2-a" href="register-payment.php">Add Purchase</a>
        <a class="nav2-a" href="register-product.php">Edit Products</a>
        <a class="nav2-a" href="report.php">Report</a>
        <?php
            if($_SESSION["user_type"] == 1){
                echo '<a class="nav2-a" href="adminpage.php">Admin Page</a>';
            }
        ?>
    </div>
</div>


    
<!-- <div class="ver-navbar">
    <a class="ver-btn" href="orders.php">Beställningar</a>
    <a class="ver-btn" href="">Lager</a>
    <a class="ver-btn" href="report.php">Rapport</a>
    <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ }
        else{
            echo '<a class="ver-btn" href="login.php">Log-in to Account</a>';
            echo '<a class="ver-btn" href="registerAccount.php">Register Account</a>';
        }

        if($_SESSION["user_type"] == 1){
            echo '<a class="ver-btn" href="adminpage.php">Admin page</a>';
        }
    ?>
    <a class="ver-btn" href="register-payment.php">Register Purchase</a>
    <a class="ver-btn" href="register-product.php">Register Product</a>
    <a class="ver-btn" href="profile.php">Profile</a>
</div> -->