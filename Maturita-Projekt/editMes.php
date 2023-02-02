<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];

    // Select the message with the given ID
    $sql = "SELECT * FROM messages WHERE id_message = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $description = $row["description"];
        $message = $row["message"]; // corrected the variable name
        $date = $row["date"];
    }
}

if (isset($_POST["submit"])) {
    $id = (int)$_POST["id"];
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);

    // Update the message with the given ID
    $sql = "UPDATE messages SET description = '$description', message = '$message' WHERE id_message = $id";
    mysqli_query($conn, $sql);

    header("Location: denikDash.php");
    exit();
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
    <title>Edit</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="denikDash.php">Back</a>
</nav>
<h1>Uprav svůj zápisek</h1>
<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" required value="<?php echo $description; ?>">
    </div>
    <div>
        <label for="message">Message</label>
        <textarea name="message" id="message" required><?php echo $message; ?></textarea>
    </div>
    <div>
        <input type="submit" name="submit" value="Ulož">
    </div>
</form>

</body>
</html>
