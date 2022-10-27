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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="container">
            <h1>Account List</h1>

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

                    echo "<h3>Results from search</h3>
                    <table>";
                    echo "<tr> <td>ID</td> <td>Username</td> <td>Email</td> <td>Reg. At</td> </tr>";
                    while($fetch = mysqli_fetch_array($query)){
                        echo '<tr value="'.$fetch['id'].'">
                                <td value="id">'. $fetch['id'] . 
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

                echo '<table id="tableSort" tableCount="'.$i.'">';
                    if($i == 1){
                        echo '<h3>Admins</h3>';
                    }
                    else{
                        echo '<h3>Users</h3>';
                    }
                    
                    $category = array("ID", "Username", "Email", "Reg. At");

                    echo "<tr>";
                    foreach ($category as $key=>$value) {
                        echo "
                        <th onclick='sortTable($key, `[tableCount=\"$i\"]`, this)' >$value
                            <span class=\"arrow-container\"></span>
                        </th>
                        ";
                    }
                    echo "</tr>";

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
        function sortTable(n, query, this_obj) {
            console.log(this_obj);
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.querySelector(query);
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            
            $(".arrow-container").text("")
            $(this_obj).find(".arrow-container").text("↑")

            // Make a loop that will continue until no switching has been done:
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                // Loop through all table rows (except the first, which contains table headers):
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    // Get the two elements you want to compare, one from current row and one from the next: 
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    // Check if the two rows should switch place, based on the direction, asc or desc: 
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } 
                    else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    // If a switch has been marked, make the switch and mark that a switch has been done: 
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount ++;
                } 
                else {
                    // If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                        $(this_obj).find(".arrow-container").text("↓")
                    }
                }
            }
        }
    </script>

<?php
    include "footer.php";
?>