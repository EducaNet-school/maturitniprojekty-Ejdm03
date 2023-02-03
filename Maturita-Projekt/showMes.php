<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_message = 0;
$description = '';
$message = '';

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id_message = (int)$_GET["id"];

    // Select the message with the given ID
    $sql = "SELECT * FROM messages WHERE id_message = $id_message";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $description = $row["description"];
        $message = $row["message"];
    }
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
    <title>Detail</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="denikDash.php">Back to list</a>
</nav>
<h1>Message detail</h1>
<form>
    <div>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="<?php echo $description; ?>" readonly>
    </div>
    <div>
        <label for="message">Message:</label>
        <textarea id="message" name="message" class="message-textarea" readonly><?php echo $message; ?></textarea>
    </div>
</form>

</body>
</html>
