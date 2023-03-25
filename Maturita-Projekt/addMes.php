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

    // Check if message length is greater than 280
    if (strlen($message) > 280) {
        $error = "Message should not be more than 280 characters";
    } else {
        // Insert message into database
        $sql = "INSERT INTO messages (description, message) VALUES ('$description', '$message')";
        $result = mysqli_query($conn, $sql);

        // Get the id of the inserted message
        $messageId = mysqli_insert_id($conn);

        // Insert a relationship between message and diary in the "M2D" table
        $sql = "INSERT INTO m2d (id_m, id_d) VALUES ('$messageId', '$id')";
        $result = mysqli_query($conn, $sql);

        header("Location: denikDash.php");
        exit;
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
    <title>Inserting</title>
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

    <h1 class="mes-popis">Přidej si zápisek</h1>
    <form action="addMes.php" method="post">
        <div>
            <input maxlength="50" type="text" name="description" id="description" placeholder="Zde vlož popisek" class="popisek" required>
        </div>
        <div>
            <textarea name="message" id="message" class="message-textarea" placeholder="Zde vlož text" maxlength="280" oninput="countChars()" required></textarea>
            <p class="count" id="charCount"></p>
        </div>
        <div>
            <input type="submit" value="Uložit" class="mes-add" id="submitBtn" disabled>
        </div>
    </form>
</div>

<script>
    function countChars() {
        var charCount = document.getElementById("message").value.length;
        var remainingChars = 280 - charCount;
        var charCountDisplay = remainingChars + "/280";
        document.getElementById("charCount").innerHTML = charCountDisplay;
        document.getElementById("submitBtn").disabled = (charCount > 280);
    }
</script>
</body>

</html>
