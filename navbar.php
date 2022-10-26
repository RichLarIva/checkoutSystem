<?php
    session_start();
?>

<div class="hor-navbar">
    <div id="brand" onclick="window.location.href='index.php'">
        <!-- <img src="images/AMI.png" alt="Account Manager Logo" class="nav-logo"> -->
        <img src="https://www.freeiconspng.com/thumbs/gear-icon/gear-icon-13.png" alt="Account Manager Logo" class="nav-logo">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/index.css">
        <h1 class="nav-h1">Butik</h1>
    </div>    
    <div class="hor-btnbox">
        <a class="hor-btn" href="login.php"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a>
        <a class="hor-btn" href=""><i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i></a>
    </div>
    <button id="menuOpen" class="btn-menu"><i class="fas fa-bars"></i></button>
</div>
<div class="ver-navbar">
    <a class="ver-btn" href="orders.php">Beställningar</a>
    <a class="ver-btn" href="">Lager</a>
    <a class="ver-btn" href="">Rapport</a>
    <a class="ver-btn" href="createTables.php">Create Tables</a>
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
    
    
    <a class="ver-btn" href="new-product.php">New product</a>



</div>