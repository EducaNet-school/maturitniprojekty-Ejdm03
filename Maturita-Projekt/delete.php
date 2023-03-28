<?php
$id = $_POST["id"];
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Delete data from messages table based on id_m (message id)
    $query_messages = "DELETE messages FROM messages JOIN m2d ON messages.id_message = m2d.id_m JOIN denik ON m2d.id_d = denik.idd WHERE denik.idd = ?";
    $stmt_messages = mysqli_prepare($conn, $query_messages);
    mysqli_stmt_bind_param($stmt_messages, "i", $id);
    mysqli_stmt_execute($stmt_messages);

    // Delete data from m2d table based on id_d (denik id)
    $query_m2d = "DELETE m2d FROM m2d JOIN denik ON m2d.id_d = denik.idd WHERE denik.idd = ?";
    $stmt_m2d = mysqli_prepare($conn, $query_m2d);
    mysqli_stmt_bind_param($stmt_m2d, "i", $id);
    mysqli_stmt_execute($stmt_m2d);

    // Delete data from u2d table based on id_d (denik id)
    $query_u2d = "DELETE FROM u2d WHERE id_d = ?";
    $stmt_u2d = mysqli_prepare($conn, $query_u2d);
    mysqli_stmt_bind_param($stmt_u2d, "i", $id);
    mysqli_stmt_execute($stmt_u2d);

    // Delete data from denik table based on id_u (user id)
    $query_denik = "DELETE FROM denik WHERE idd = ?";
    $stmt_denik = mysqli_prepare($conn, $query_denik);
    mysqli_stmt_bind_param($stmt_denik, "i", $id);
    mysqli_stmt_execute($stmt_denik);

    // Delete data from users table based on id
    $query_users = "DELETE FROM users WHERE id = ?";
    $stmt_users = mysqli_prepare($conn, $query_users);
    mysqli_stmt_bind_param($stmt_users, "i", $id);
    mysqli_stmt_execute($stmt_users);

    // Commit transaction
    mysqli_commit($conn);
    header("Location: AdminDashboard.php");
} catch (Exception $e) {
    // Roll back transaction on error
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}