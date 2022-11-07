<?php
    include "pub-funcs.php";
?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/index.css">
        <title>Register</title>
    </head>
    <body>
    <?php
        include 'navbar.php';
        include 'config.php';
        $shoudAccountCreate = true;
    ?>

    <div class="container">
        <form action="" method="POST" class="formcont">
            <h1 class="form-h1">Register</h1>
            <hr class="form-hr">
            <div class="formbox">
                <label for="username" class="formlabel">Username:</label><br>
                <input type="text" class="forminput" name="username" minlength="4" maxlength="30" required><br>
            </div>

            <?php
                checkIfNotUnique($conn, "username");
            ?>
            
            <div class="formbox">
                <label for="email" class="formlabel">Email:</label><br>
                <input type="email" class="forminput" name="email" required><br>
            </div>

            <?php
                checkIfNotUnique($conn, "email");
            ?>

            <div class="formbox">
                <label for="password" class="formlabel">Password:</label><br>
                <input type="password" class="forminput" name="password" required><br>
            </div>

            <div class="formbox"><input type="submit" class="forminput" name="reg" value="Create Account"></div>

            <?php
                if(isset($_POST['reg']) && $shoudAccountCreate){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $passwrd = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $splregAccount = "INSERT INTO Accounts (Username, Passwrd, Email) VALUES ('$username', '$passwrd', '$email')";
                
                    if(mysqli_query($conn, $splregAccount)){
                        echo "Account Created :)";
                    }
                    else{
                        echo "Something went wrong :(";
                    }
                }
            ?>
        </form>
    </div>

    <?php
    include "footer.php";
?>