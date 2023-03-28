<?php
$id = $_POST["id"];

include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// delete vztah
$sql = "DELETE FROM m2d WHERE id_m = '$id'";

if (!mysqli_query($conn, $sql)) {
    echo "Chyba mazani " . mysqli_error($conn);
    mysqli_close($conn);
    exit();
}

// delete zpravy
$sql = "DELETE FROM messages WHERE id_message = '$id'";

if (mysqli_query($conn, $sql)) {
    header("Location: denikDash.php");
} else {
    echo "Chyba pri mazani: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
