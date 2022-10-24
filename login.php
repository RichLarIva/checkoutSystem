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
    <?php
        // include 'navbar.php';
    ?>

    <form action="#" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username">
        
        <label for="password">Password:</label>
        <input type="password" name="password">

        <input type="submit" name="login">
    </form>

    <?php
        include 'config.php';

        
        // $splAccounts = "CREATE TABLE Accounts (
        //     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        //     username VARCHAR(50) NOT NULL UNIQUE KEY,
        //     user_type TINYINT(1) DEFAULT(0),
        //     passwrd VARCHAR(250) NOT NULL,
        //     email VARCHAR(100) NOT NULL,
        //     reg_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        // )";

        // if(mysqli_query($conn, $splAccounts)){
        //     echo "table created :)";
        // }
        // else{
        //     echo "no table created :(";
        // }
        
        // $splregAccount = "INSERT INTO Accounts (Username, User_Type, Passwrd, Email) VALUES ('testAccount', '1', 'password123', 'test@bruhmail.com')";
        
        // if(mysqli_query($conn, $splregAccount)){
        //     echo "account created :)";
        // }
        // else{
        //     echo "no account created :(";
        // }

        if(!isset($_POST['username'], $_POST['password'])){
            exit('Username or Password is emtpy.');
        }

        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $usersPasswrd = "SELECT * FROM Accounts WHERE username='$username'";
            $res = mysqli_query($conn, $usersPasswrd);
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

            // print_r($row);
            // print_r($_POST['password'] ."<br>". $row['passwrd']);

            // remember to use password_verify() when the passwords get hashed later
            if($_POST['password'] == $row['passwrd']){

                if($row['user_type'] == '1'){
                    // relocate to admin page after log in
                    header("location: adminpage.php");
                }
                else{
                    // relocate to normal user page
                    echo "hello user";
                }
            }
            else{
                // show some error message
                echo "Wrong password";
            }

        }


    
    ?>

</body>
</html>