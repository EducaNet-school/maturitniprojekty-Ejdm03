<?php
$id = $_POST["id"];
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// spusteni transakce
mysqli_begin_transaction($conn);

try {
    // maze data z messages
    $query_messages = "DELETE messages FROM messages JOIN m2d ON messages.id_message = m2d.id_m JOIN denik ON m2d.id_d = denik.idd WHERE denik.idd = ?";
    $stmt_messages = mysqli_prepare($conn, $query_messages);
    mysqli_stmt_bind_param($stmt_messages, "i", $id);
    mysqli_stmt_execute($stmt_messages);

    // maze data z m2d
    $query_m2d = "DELETE m2d FROM m2d JOIN denik ON m2d.id_d = denik.idd WHERE denik.idd = ?";
    $stmt_m2d = mysqli_prepare($conn, $query_m2d);
    mysqli_stmt_bind_param($stmt_m2d, "i", $id);
    mysqli_stmt_execute($stmt_m2d);

    // maze data z u2d
    $query_u2d = "DELETE FROM u2d WHERE id_d = ?";
    $stmt_u2d = mysqli_prepare($conn, $query_u2d);
    mysqli_stmt_bind_param($stmt_u2d, "i", $id);
    mysqli_stmt_execute($stmt_u2d);

    // maze data z denik
    $query_denik = "DELETE FROM denik WHERE idd = ?";
    $stmt_denik = mysqli_prepare($conn, $query_denik);
    mysqli_stmt_bind_param($stmt_denik, "i", $id);
    mysqli_stmt_execute($stmt_denik);

    // maze data z users
    $query_users = "DELETE FROM users WHERE id = ?";
    $stmt_users = mysqli_prepare($conn, $query_users);
    mysqli_stmt_bind_param($stmt_users, "i", $id);
    mysqli_stmt_execute($stmt_users);

    // potvrzeni transakce
    mysqli_commit($conn);
    header("Location: AdminDashboard.php");
} catch (Exception $e) {
    // vrati zpet stav pokud chyba
    mysqli_rollback($conn);
    echo "Chyba, pošli nám tuto chybovou hlášku na email: " . $e->getMessage();
}