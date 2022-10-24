<?php
    require "config.php";
    $sql = "CREATE TABLE item(
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        best_before VARCHAR(11),
        barcode VARCHAR(15)
    )";

    if($conn->query($sql) === TRUE){
        echo "Table item created successfully";
    }
    else{
        echo "ERROR creating table: ".$conn->error;
    }
    // $sql = "CREATE TABLE product(
    //     id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     price DOUBLE(11,2) NOT NULL,
    //     amount INT(11),
    //     name VARCHAR(200) NOT NULL,
    //     image VARCHAR(200) NOT NULL,
    //     descr TEXT(1500) NOT NULL,
    //     category VARCHAR(30) NOT NULL,
    //     barcode INT(15)
    // );";

    // if($conn->query($sql) === TRUE){
    //     echo "Table Product created successfully";
    // }
    // else{
    //     echo "ERROR creating table: ".$conn->error;
    // }
    
    $conn->close();
?>