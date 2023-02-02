<?php
$id = $_COOKIE["id"];
$idd = $_COOKIE["id_d"];

$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_POST) {
    $description = $_POST["description"];

    // Vložení zprávy do tabulky "messages"
    $sql = "INSERT INTO messages (description, message) VALUES ('$description', '')";
    $result = mysqli_query($conn, $sql);

    // Získání ID vložené zprávy
    $messageId = mysqli_insert_id($conn);

    // Vložení vztahu mezi zprávou a deníkem do tabulky "M2D"
    $sql = "INSERT INTO M2D (id_m, id_d) VALUES ('$messageId', '$id')";
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
    <title>Vkladani</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="logout.php">Logout</a>
    <a href="index.php">Back</a>
</nav>
<h1>Přidat zprávu</h1>
<form action="vkladaniMes.php" method="post">
    <div>
        <label for="description">Popis:</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <input type="submit" value="Save">
    </div>
</form>
</body>
</html>
