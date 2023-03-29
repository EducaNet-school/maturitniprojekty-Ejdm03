<?php
$id = $_POST["id"];

include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// transakce zacatek
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
    echo "Chyba v mazani zápisku, pošli nám tuto chybu na email: " . mysqli_error($conn);
}

mysqli_close($conn);
?>