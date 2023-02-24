<?php



$id = $_GET["id"];
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo $id;
//Delete data from users table based on id
$querry = "DELETE FROM users WHERE id= $id";
$resultt = mysqli_query($conn, $querry);

if ($resultt) {
    header("Location: AdminDashboard.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}



?>