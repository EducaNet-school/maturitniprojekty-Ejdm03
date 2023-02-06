<?php
$id = $_COOKIE["id"];
$idd = $_COOKIE["id_d"];

include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_POST) {
    $description = $_POST["description"];
    $message = $_POST["message"];

    // vloz zpravu
    $sql = "INSERT INTO messages (description, message) VALUES ('$description', '$message')";
    $result = mysqli_query($conn, $sql);

    // dostane id z mes
    $messageId = mysqli_insert_id($conn);

    // Vložte vztah mezi zprávou a deníkem do tabulky "M2D".
    $sql = "INSERT INTO m2d (id_m, id_d) VALUES ('$messageId', '$id')";
    $result = mysqli_query($conn, $sql);

    header("Location: denikDash.php");
    exit;
}

mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inserting</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="logout.php">Logout</a>
    <a href="denikDash.php">Back</a>
</nav>
<h1>Add Message</h1>
<form action="addMes.php" method="post">
    <div>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description">
    </div>
    <div>
        <label for="message">Message:</label>
        <textarea name="message" id="message" class="message-textarea"></textarea>
    </div>
    <div>
        <input type="submit" value="Save">
    </div>
</form>
</body>
</html>
