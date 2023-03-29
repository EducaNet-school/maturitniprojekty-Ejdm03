<?php
include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
$description = '';
$message = '';

if ($id > 0) {
    $sql = "SELECT * FROM messages WHERE id_message = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $description = $row["description"];
        $message = $row["message"];
    }
}

if (isset($_POST["submit"]) && $id > 0) {
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);
    $date = date("Y-m-d H:i:s");
    // Update the message with the given ID
    $sql = "UPDATE messages SET description = ?, message = ?, date = ? WHERE id_message = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $description, $message, $date, $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: denikDash.php");
        exit();
    } else {
        echo "Chyba v upravovani zapisku, pošli nám prosím tuto chybovou hlášku: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
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
<h1 class="mes-popis">Uprav svůj zápisek</h1>
<form action="editMes.php" method="post">
        <?php if ($id > 0): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <input type="text" maxlength="50" name="description" id="description" class="popisek" required value="<?php echo $description; ?>">
            </div>
            <div>
                <textarea name="message" maxlength="280" oninput="countChars()" id="message" class="message-textarea"  required><?php echo $message; ?></textarea>
                <p class="count" id="charCount"></p>
            </div>
            <div>
                <input type="submit" name="submit" class="mes-add" value="Ulož">
            </div>
        <?php else: ?>
            <span>No message ID specified.</span>
        <?php endif; ?>
    </form>

</div>
</body>
<script>
    function countChars() {
        var charCount = document.getElementById("message").value.length;
        var remainingChars = 280 - charCount;
        var charCountDisplay = remainingChars + "/280";
        document.getElementById("charCount").innerHTML = charCountDisplay;
        document.getElementById("submitBtn").disabled = (charCount > 280);
    }

    document.addEventListener("DOMContentLoaded", function() {
        var textarea = document.getElementById("message");
        textarea.addEventListener("input", countChars);
        countChars(); // call countChars on page load to show the initial character count
    });
</script>

</html>