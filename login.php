<?php 
session_start(); 
include 'config.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    header("location: profile.php");
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $usersPasswrd = "SELECT * FROM Accounts WHERE username='$username'";
    $res = mysqli_query($conn, $usersPasswrd);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    if(password_verify($_POST['password'],$row['passwrd'])){
        $_SESSION["user_type"] = $row['user_type'];
        $_SESSION["loggedin"] = true;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        
        if($row['user_type'] == 1){
            // relocate to admin page after log in
            $_SESSION['isAdmin'] = true;
            header("Location: adminpage.php");die();
        }
        else{
            // relocate to normal user page
            $_SESSION['isAdmin'] = false;
            header("location: index.php");die();
        }
    }
    else{
        // show some error message
        echo "Wrong password";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Login</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <form action="" method="POST" class="formcont">
            <h1 class="form-h1">Log in</h1>
            <hr class="form-hr">
            <div class="formbox">
                <label for="username" class="formlabel">Username:</label>
                <input type="text" class="forminput" name="username">
            </div>

            <div class="formbox">
                <label for="password" class="formlabel">Password:</label>
                <input type="password" class="forminput" name="password">
            </div>
            <div class="formbox"><input type="submit" class="forminput" name="login"></div>
            <p class="register-para">Don't have an account? <a href="registerAccount.php">Register here!</a></p>
        </form>
    </div>

    <?php
    include "footer.php";
?>