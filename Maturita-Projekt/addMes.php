<?php
$error = '';

// Check if the required cookies are set
if (isset($_COOKIE['id'], $_COOKIE['id_d'])) {
    $id = $_COOKIE['id'];
    $id_d = $_COOKIE['id_d'];

    // Connect to the database
    include 'connection.php';

    if ($conn) {
        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];
            $message = $_POST['message'];

            // Check character count
            if (strlen($message) > 280) {
                $error = 'Message should not be more than 280 characters';
            } else {
                // Insert message into database
                $stmt = mysqli_prepare($conn, 'INSERT INTO messages (description, message) VALUES (?, ?)');
                mysqli_stmt_bind_param($stmt, 'ss', $description, $message);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    // Get inserted message ID
                    $messageId = mysqli_insert_id($conn);

                    // Create relationship
                    $stmt = mysqli_prepare($conn, 'INSERT INTO m2d (id_m, id_d) VALUES (?, ?)');
                    mysqli_stmt_bind_param($stmt, 'ii', $messageId, $id);
                    $result = mysqli_stmt_execute($stmt);

                    if ($result) {
                        // Redirect to dashboard
                        header('Location: denikDash.php');
                        exit;
                    } else {
                        $error = 'Error creating message relationship';
                    }
                } else {
                    $error = 'Error creating message';
                }
            }
        }

        mysqli_close($conn);
    } else {
        $error = "Connection failed: " . mysqli_connect_error();
    }
} else {
    $error = 'User ID cookies are not set';
}
?>

<!doctype html>
<html lang="cs">
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
    <?php if ($error) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
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
        var charCount = document.getElementById('message').value.length;
        var remainingChars = 280 - charCount;
        var charCountDisplay = remainingChars + '/280';
        document.getElementById('charCount').innerHTML = charCountDisplay;
        document.getElementById('submitBtn').disabled = (charCount > 280);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var textarea = document.getElementById('message');
        textarea.addEventListener('input', countChars);
        countChars(); // call countChars on page load to show the initial character count
    });
</script>

</body>
</html>