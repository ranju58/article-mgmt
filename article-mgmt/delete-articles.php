<?php
include("connection.php");
$id = $_GET['id'];

// sql to delete a record
$sql = "DELETE FROM articles WHERE id = $id"; 

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: dashboard.php');
    exit;
} else {
    echo "Error deleting record";
}
?>