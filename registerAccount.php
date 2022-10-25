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
    ?>

    <div class="container">
        <form action="#" method="POST" class="formcont">
            <h1 class="form-h1">Register</h1>
            <hr class="form-hr">
            <div class="formbox">
                <label for="username" class="formlabel">Username:</label><br>
                <input type="text" class="forminput" name="username"><br>
            </div>
            
            <div class="formbox">
                <label for="email" class="formlabel">Email:</label><br>
                <input type="text" class="forminput" name="email"><br>
            </div>

            <div class="formbox">
                <label for="password" class="formlabel">Password:</label><br>
                <input type="password" class="forminput" name="password"><br>
            </div>

            <div class="formbox"><input type="submit" class="forminput" name="reg" value="Create Account"></div>


            <?php
                include 'config.php';



                if(isset($_POST['reg'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $passwrd = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $splregAccount = "INSERT INTO Accounts (Username, Passwrd, Email) VALUES ('$username', '$passwrd', '$email')";
                
                    if(mysqli_query($conn, $splregAccount)){
                        echo "account created :)";
                    }
                    else{
                        echo "no account created :(";
                    }
                }

            
            ?>
        </form>
    </div>
</body>
</html>