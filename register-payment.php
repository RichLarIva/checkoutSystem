<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    <div class="container">
    <?php
    require "config.php";
    $sql = "SELECT * FROM item ORDER BY best_before";
    $res = $conn->query($sql);

    $i = mysqli_fetch_assoc($res);
        echo($i["best_before"]."\n");
    

    $sql = "SELECT * FROM product ORDER BY name";
    $res = $conn->query($sql);

    while($i = mysqli_fetch_assoc($res)){
        echo($i["name"]."\n");
    }
    ?>
    </div>

<?php
    include "footer.php";
?>