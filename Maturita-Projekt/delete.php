<?php

$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET["id"];

//Delete data from users table based on id
$query = "DELETE FROM users WHERE id=$id";
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: AdminDashboard.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

?>