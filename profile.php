<?php 
session_start(); 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true){
    header("Location: index.php");die();
}

include 'config.php';

$id = $_SESSION['id'];

$userInfo = "SELECT * FROM Accounts WHERE id='$id'";

$res = mysqli_query($conn, $userInfo);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

if(isset($_POST['updateProfile'])){
    
    if (trim($_POST['currentPassword'], " ") != "" && trim($_POST['newPassword'], " ") != "" && trim($_POST['repeatPassword'], " ") != ""){

        $currentPassword = $_POST['currentPassword'];

        if(password_verify($currentPassword, $row['passwrd'])){
            if($_POST['repeatPassword'] == $_POST['newPassword']){
                $newPasswrd = password_hash($_POST['repeatPassword'], PASSWORD_DEFAULT);
                $updateUserInfo = "UPDATE Accounts SET passwrd = '$newPasswrd' WHERE id ='$id'";

                if(mysqli_query($conn, $updateUserInfo)){
                    echo "Password changed";
                }
                else{
                    echo "Password didnt change :(";
                }

            }
            else{
                echo "Passwords doesn't match";
            }
        }
        else{
            echo "Wrong Password";
        }
    }
    else{
        echo "Please enter passwords";
    }

    if(trim($_POST['username'], " ") != ""){
        $newUsername = $_POST['username'];
        $updateUserInfo = "UPDATE Accounts SET username = '$newUsername' WHERE id ='$id'";

        if(mysqli_query($conn, $updateUserInfo)){
            echo "Username changed";
            $_SESSION['username'] = $newUsername;
        }
        else{
            echo "Username didn't change :(";
        }
    }

    if(trim($_POST['email'], " ") != ""){
        $newEmail = $_POST['email'];
        $updateUserInfo = "UPDATE Accounts SET email = '$newEmail' WHERE id ='$id'";

        if(mysqli_query($conn, $updateUserInfo)){
            echo "Email changed";
            $_SESSION['email'] = $newEmail;
        }
        else{
            echo "Email didn't change :(";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <style>
body {
    text-align: center;
    background-color: gray;
}
p {
  color: green;

}
h2 {
  color: black;
}
.profileInfo {
    border: 5px solid black;
    border-radius: 25px;
    padding: 5%;
    width: 25%;
    height: auto;
    text-align: center;
    margin: auto;
    background-color: white;
}

/* If the screen size is 601px wide or more, set the font-size of <div> to 80px */
@media screen and (min-width: 601px) {
  .profileInfo {
    font-size: 25px;
  }
}

/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 600px) {
  .profileInfo {
    font-size: 10px;
  }
}
</style>
</head>
<body>
    <a href="index.php">Home</a>

    <div class="profileInfo">
        <h2 class="profileTitel">Welcome: <?php echo $_SESSION['username']; ?></h2>
        <p class="username">Username: <?php echo $_SESSION['username']; ?></p>
        <p class="email">Email: <?php echo $_SESSION['email']; ?></p>
        <button id="editBtn">Edit Profile</button>
        <a href="logout.php" id="signoutBtn">Sign Out</a>
    </div><br>
    <div id="editProfile" hidden>
        <form action="" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" name="username" <?php echo 'placeholder="'.$row['username'].'"'?>><br>
            <label for="email">Email:</label><br>
            <input type="text" name="email" <?php echo 'placeholder="'.$row['email'].'"'?>><br><br>
            <label for="currentPassword">Current Password:</label><br>
            <input type="password" name="currentPassword"><br>
            <label for="newPassword">New Password:</label><br>
            <input type="password" name="newPassword"><br>
            <label for="repeatPassword">Repeat Password:</label><br>
            <input type="password" name="repeatPassword"><br><br>
            <input type="submit" name="updateProfile" value="Update Profile">
            
        </form>

        <input type="submit" name="deleteProfile" value="Delete Profile" onclick="showConfirmation()">


        <div id="confirm" hidden>
            <h3>Confirmation</h3>
            <p>Do you really want to reset the database?</p>
            <button onclick="deleteProfile()">Yes</button>
            <button onclick="closeDelete()">No</button>  
        </div>
    </div>
    <script defer>
        var editBtn = document.getElementById("editBtn");
        var editProfile = document.getElementById("editProfile");

        editBtn.addEventListener("click", showEdit);
        

        function showEdit() {
            editProfile.hidden=false;
        }

        function showConfirmation() {
            document.getElementById("confirm").hidden=false;
        }

        function deleteProfile() {
            location.href = './deleteProfile.php';
        }

        function closeDelete() {
            document.getElementById("confirm").hidden=true
        }

    </script>

<?php
    include "footer.php";
?>