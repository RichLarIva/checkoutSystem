<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $db = "shopDB";
    
    # Creates the conbnection
    $conn = new mysqli($serverName, $userName, $password, $db);

    #Checks the connection
    if($conn->connect_error){
        die("Connection failed: ".$conn->connect_error);
    }
?>