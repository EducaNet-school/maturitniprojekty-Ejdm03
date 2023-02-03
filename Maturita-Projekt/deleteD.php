<?php
$id = $_GET["id"];

$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// delete vzat
$sql = "DELETE FROM m2d WHERE id_m = '$id'";

if (!mysqli_query($conn, $sql)) {
    echo "Error deleting related records: " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

// delete zpravy
$sql = "DELETE FROM messages WHERE id_message = '$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: denikDash.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
