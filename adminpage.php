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
                ?>

                <form action="" method="POST">
                    <input type="text" placeholder="Search for account..." name="keyword" required value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>">
                    <button name="search">Search</button>
                </form>
                
                <?php
                    if(isset($_POST['keyword'])){
                        $keyword = $_POST['keyword'];

                        $query = mysqli_query($conn, "SELECT * FROM Accounts WHERE username LIKE '%$keyword%' ORDER BY username");

                        echo "<h3>Results</h3> <table>";
                        echo "<tr> <td>ID</td> <td>Username</td> <td>Email</td> <td>Reg. At</td> </tr>";
                        while($fetch = mysqli_fetch_array($query)){
                            echo '<tr value="'.$fetch['id'].'"><td value="id">'. $fetch['id'] . 
                                    '</td><td value="uname">' . $fetch['username'] . 
                                    '</td><td value="email">' . $fetch['email'] . 
                                    '</td><td value="regAt">' . $fetch['reg_at'] . 
                                    '</td><td>
                                        <form action="" method="POST">';
                                        if($fetch['user_type'] != "1"){
                                            echo '<button type="submit" name="makeAdmin" value="'.$fetch['id'].'">Make Admin</button>
                                                <button type="submit" name="delete" value="'.$fetch['id'].'">Delete</button>';

                                        }
                                        else{
                                            echo '<button type="submit" name="unAdmin" value="'.$fetch['id'].'">un Admin</button>';
                                        }
                            echo '</form></td></tr>';
                        }
                        echo "</table>";
                    }
                ?>
                
                <br>
                
                <?php
                for ($i=1; $i >= 0; $i--) { 
                    $data = "SELECT * FROM Accounts";
                    $res = mysqli_query($conn, $data);

                    echo "<table>";
                        if($i == 1){
                            echo '<h3>Admins</h3>';
                        }
                        else{
                            echo '<h3>Users</h3>';
                        }
                        echo "<tr> <td>ID</td> <td>Username</td> <td>Email</td> <td>Reg. At</td> </tr>";
                        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
                            if ($row['user_type'] == $i){
                                echo '<tr value="'.$row['id'].'"><td value="id">'. $row['id'] . 
                                    '</td><td value="uname">' . $row['username'] . 
                                    '</td><td value="email">' . $row['email'] . 
                                    '</td><td value="regAt">' . $row['reg_at'] . 
                                    '</td><td>
                                        <form action="" method="POST">';
                                        if($row['user_type'] != "1"){
                                            echo '<button type="submit" name="makeAdmin" value="'.$row['id'].'">Make Admin</button>
                                                <button type="submit" name="delete" value="'.$row['id'].'">Delete</button>';

                                        }
                                        else{
                                            echo '<button type="submit" name="unAdmin" value="'.$row['id'].'">un Admin</button>';
                                        }
                                    echo '</form>
                                    </td></tr>';
                            }
                        }
                    echo "</table><br>";
                }
            ?>
        </div>

        <script defer>
            function sortTable(){

            }
        </script>

        <?php
    include "footer.php";
?>