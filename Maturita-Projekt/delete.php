<?php
$id = $_GET["id"];
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Disable foreign key checks
mysqli_query($conn, "SET foreign_key_checks = 0");



// Delete data from messages table based on id_m (message id)
$query_messages = "DELETE FROM messages WHERE id_message IN (SELECT id_m FROM m2d WHERE id_d IN (SELECT idd FROM denik WHERE idd = $id))";
$result_messages = mysqli_query($conn, $query_messages);

// Delete data from m2d table based on id_d (denik id)
$query_m2d = "DELETE FROM m2d WHERE id_d IN (SELECT idd FROM denik WHERE idd = $id)";
$result_m2d = mysqli_query($conn, $query_m2d);

// Delete data from u2d table based on id_u (user id)
$query_u2d = "DELETE FROM u2d WHERE id_d = $id";
$result_u2d = mysqli_query($conn, $query_u2d);


// Delete data from denik table based on id_u (user id)
$query_denik = "DELETE FROM denik WHERE idd = $id";
$result_denik = mysqli_query($conn, $query_denik);

// Delete data from users table based on id
$query_users = "DELETE FROM users WHERE id = $id";
$result_users = mysqli_query($conn, $query_users);

// Enable foreign key checks
mysqli_query($conn, "SET foreign_key_checks = 1");

if ($result_users && $result_denik && $result_messages && $result_u2d && $result_m2d) {
    header("Location: AdminDashboard.php");
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
