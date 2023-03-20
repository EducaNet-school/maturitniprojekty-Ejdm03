<?php
include "connection.php";


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_message = 0;
$description = '';
$message = '';

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id_message = (int)$_POST["id"];

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
    <link rel="stylesheet" href="styltest.css">
</head>
<body class="show-mes-body">
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




<div class="mes-container">
<h1 class="mes-popis"><?php echo $description; ?></h1>
<form>
    <div>
        <textarea id="message" name="message" class="message-textarea" readonly><?php echo $message; ?></textarea>
    </div>
</form>
</div>

</body>
</html>
