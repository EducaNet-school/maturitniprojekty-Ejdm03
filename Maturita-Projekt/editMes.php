<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = 0;
$description = '';
$message = '';

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = (int)$_GET["id"];


    $sql = "SELECT * FROM messages WHERE id_message = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $description = $row["description"];
        $message = $row["message"];
    }
}

if (isset($_POST["submit"]) && !empty($_POST["id"])) {
    $id = (int)$_POST["id"];
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);
    $date = date("Y-m-d H:i:s");
    // Update the message with the given ID
    $sql = "UPDATE messages SET description = '$description', message = '$message', date = '$date' WHERE id_message = $id";
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
<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="">OnlineD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="denikDash.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Zpět</span></span></a>
        </div>
    </nav>
</header>

<br>
<br>
<br>
<h1>Uprav svůj zápisek</h1>
<form action="editMes.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div>
        <label for="description">Description</label>
        <input type="text" name="description" id="description" required value="<?php echo $description; ?>">
    </div>
    <div>
        <label for="message">Message</label>
        <textarea name="message" id="message" class="message-textarea"  required><?php echo $message; ?></textarea>
    </div>
    <div>
        <input type="submit" name="submit" value="Ulož">
    </div>
</form>
</body>
</html>