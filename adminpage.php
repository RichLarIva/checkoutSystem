<?php
session_start();

if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != true){
    header("Location: index.php");die();
}
?>

<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Admin Page</title>
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="container">
            <h1>adminpage</h1>

            <?php
                include 'config.php';

                if(isset($_POST['makeAdmin'])){
                    $clickedUser = $_POST['makeAdmin'];
                    
                    $updateUserType = "UPDATE Accounts SET user_type = '1' WHERE id ='$clickedUser'";

                    if(mysqli_query($conn, $updateUserType)){
                        echo "Updated account :)";
                    }
                    else{
                        echo "no update :(";
                    }
                    
                }

                if(isset($_POST['unAdmin'])){
                    $clickedUser = $_POST['unAdmin'];
                    
                    $updateUserType = "UPDATE Accounts SET user_type = '0' WHERE id ='$clickedUser'";

                    if(mysqli_query($conn, $updateUserType)){
                        echo "Updated account :)";
                    }
                    else{
                        echo "no update :(";
                    }
                    
                }

                if(isset($_POST['delete'])){
                    $clickedUser = $_POST['delete'];

                    $sqlDelete = "DELETE FROM Accounts WHERE id='$clickedUser'";

                    if (mysqli_query($conn, $sqlDelete)) {
                        echo "User deleted successfully";
                    } 
                    else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                    
                }

                $data = "SELECT * FROM Accounts";
                $res = mysqli_query($conn, $data);

                echo "<table>";
                echo "<tr> <td>ID</td> <td>Username</td> <td>User Type</td> <td>Email</td> <td>Reg. At</td> </tr>";
                while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                    echo '<tr value="'.$row['id'].'"><td value="id">'. $row['id'] . 
                    '</td><td value="uname">' . $row['username'] . 
                    '</td><td value="uType">' . $row['user_type'] . 
                    '</td><td value="email">' . $row['email'] . 
                    '</td><td value="regAt">' . $row['reg_at'] . 
                    '</td><td>
                        <form action="" method="POST">
                        <button type="submit" name="makeAdmin" value="'.$row['id'].'">Make Admin</button>
                        <button type="submit" name="unAdmin" value="'.$row['id'].'">un Admin</button>
                    ';

                    if($row['user_type'] != "1"){
                        echo '<button type="submit" name="delete" value="'.$row['id'].'">Delete</button>';
                    }


                    echo '</form>
                    </td></tr>';
                }
                echo "</table>";

            ?>
        </div>

        <?php
    include "footer.php";
?>