
<?php

include "connection.php";


if (isset($_POST["ok"])) {

    if ($_POST["hesloAdmin"] == "pesjelesbum") {
        $admin_value = 1;
    } else {
        $admin_value = 0;
    }

    $jmeno = $_POST["jmeno"];
    $prijmeni = $_POST["prijmeni"];
    $email = $_POST["email"];
    $heslo = $_POST["heslo"];

    // Kontrola, zda e-mail není již použitý
    $select_email = "SELECT email FROM users WHERE email='$email'";
    $email_result = mysqli_query($conn, $select_email);

    if (mysqli_num_rows($email_result) > 0) {
        $usedem= "Tento e-mail je již použitý";

    } else {
        $insert = "INSERT INTO users (firstname, surname, email, password, adminRole) VALUES ('$jmeno','$prijmeni','$email','$heslo', $admin_value) ";
        $reg="Úspěšne jsi se registroval, teď se můžeš přihlásit ";

        $result = mysqli_query($conn, $insert);
        if (!$result) {
            die("Chyba v prikazu " . mysqli_error($conn));
        }
    }
}


?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online deníček</title>
    <link rel="stylesheet" href="styltest.css">
</head>
<body class="login">

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
            <a href="registrace.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Registrace</span></span></a>

        </div>
    </nav>
</header>
<br>
<br>
<br>
<br>

<div class="form-register">
    <div class="title">Registrace</div>

    <form method="post" action="registrace.php">
        <div class="input-container ic1">
            <input id="jmeno" class="input" type="text" name="jmeno" placeholder=" " required>
            <div class="cut"></div>
            <label for="jmeno" class="placeholder">Jméno</label>
        </div>
        <div class="input-container ic2">
            <input id="prijmeni" class="input" type="text" name="prijmeni" placeholder=" " required>
            <div class="cut"></div>
            <label for="prijmeni" class="placeholder">Příjmení</label>
        </div>
        <div class="input-container ic2">
            <input id="email" class="input" type="email" name="email" placeholder=" " required>
            <div class="cut"></div>
            <label for="email" class="placeholder">Email</label>
        </div>
        <div class="input-container ic2">
            <input id="heslo" class="input" type="password" name="heslo" placeholder=" " required>
            <div class="cut"></div>
            <label for="heslo" class="placeholder">Heslo</label>
        </div>
        <div class="input-container ic2">
            <input id="hesloAdmin" class="input" type="password" name="hesloAdmin" placeholder=" ">
            <div class="cut"></div>
            <label for="hesloAdmin" class="placeholder">Admin heslo</label>
        </div>
        <div class="resetB">
            <a href="prihlaseni.php">Již máš účet? Přihlaš se.</a>
        </div>
        <?php if (isset($usedem)): ?>
            <h3 class="error-message"><?php echo $usedem; ?></h3>
        <?php endif; ?>

        <?php if (isset($reg)): ?>
            <h3 class="success-message"><?php echo $reg; ?></h3>
        <?php endif; ?>



        <button type="submit" class="submit" name="ok">Registrovat se</button>
    </form>
</div>

</body>
</html>