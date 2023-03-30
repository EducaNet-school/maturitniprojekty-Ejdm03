<?php

include "connection.php";

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



if (isset($_POST['reset'])) {
    // ziska email z formulare
    $email = $_POST['email'];

    // pripojeni do db

    // kontrola zda email existuje v db
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // generuje nove heslo
        $new_password = substr(md5(rand()), 0, 7);
        // updatuje heslo v db
        $update_query = "UPDATE users SET password='$new_password' WHERE email='$email'";
        mysqli_query($conn, $update_query);
        // Send an email with the new password to the user
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'onlinedenicek@gmail.com';
        $mail->Password = '';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('info@onlined.com', 'Onlined');
        $mail->addAddress($email);
        $mail->Subject = 'Password reset';
        $mail->Body = "Tvé nové heslo je: " . $new_password;
        $mail->send();


        echo "<div id='loader'>
    <div class='loader'></div>
</div>";

        $emailok="Heslo bylo resetováno a bylo posláno na tvůj email. Budeš přesměrován na Příhlášení za";
        $countdown = 6; // set the countdown time in seconds
        header("Refresh: $countdown; url=prihlaseni.php");


    } else {


        $emailnone="Účet s tímto e-maile nebyl nalezen v naší databázi, zkus to znovu";

    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>



<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset hesla</title>
    <link rel="stylesheet" href="styltest.css">
</head>


<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="index.php">OnlineD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="index.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Domů</span></span></a>
            <a href="prihlaseni.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Přihlášení</span></span></a>
            <a href="" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Obnova Hesla</span></span></a>
            <a href="registrace.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Registrace</span></span></a>

        </div>
    </nav>
</header>






<body class="login">

<div class="form-login">
    <div class="title">Obnova Hesla</div>
    <form method="post" action="resetpassword.php">
        <div class="input-container ic1">
            <input type="email" id="email" name="email" class="input">
            <div class="cut"></div>
            <label for="email" class="placeholder">Email:</label>
            </div>
        <?php if (isset($emailnone)): ?>
            <h3 class="error-message"><?php echo $emailnone; ?></h3>
        <?php endif; ?>


        <?php if (isset($emailok)): ?>
            <h3 class="okreset">
                <?php echo " Heslo bylo vygenerováno a posláno na tvůj email.   Stránka bude automaticky přesměrována za <span id='countdown'>$countdown</span> sekund."; ?>
            </h3>
            <script>
                // odpocet
                var countdown = <?php echo $countdown; ?>;

                // updatuje odpocet kazdou sekundu
                setInterval(function() {
                    countdown--;
                    document.getElementById('countdown').innerHTML = countdown;
                }, 1000);

                // presmerovani po konci casovace
                setTimeout(function() {
                    window.location.href = "prihlaseni.php";
                }, countdown * 1000);
            </script>
        <?php endif; ?>



        <button type="submit" name="reset" class="submit">Resetovat Heslo</button>
    </form>
</div>





</body>

</html>
