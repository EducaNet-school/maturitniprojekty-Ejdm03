<?php
$id = $_POST["id"];

include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Using a transaction to ensure atomicity
mysqli_begin_transaction($conn);

try {
    // delete vztah
    $sql = "DELETE FROM m2d WHERE id_m = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // delete zpravy
    $sql = "DELETE FROM messages WHERE id_message = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_commit($conn);
    header("Location: denikDash.php");
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error deleting message: " . mysqli_error($conn);
}

mysqli_close($conn);
?>