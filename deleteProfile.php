<?php
session_start(); 
include 'config.php';

$id = $_SESSION['id'];
$sqlDelete = "DELETE FROM Accounts WHERE id ='$id'";

if (mysqli_query($conn, $sqlDelete)) {
    $_SESSION = array();
    $_SESSION["loggedin"] = false;
    header("location: index.php");die();
} 
else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>