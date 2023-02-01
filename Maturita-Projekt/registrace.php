
<?php

$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

// pripojeni do db
$conn = mysqli_connect($servername, $username, $password, $db);

// pripojeni kontrola
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["ok"])) {
    if ($_POST["adminheslo"] == "7p+CwFm4HTpOpUB4W8yqrqy6gWKG5kRMvYMDU2GX1x8=") {
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
        echo $usedem;
    } else {
        $reg="Úspěšne jsi se registroval, teď se můžeš přihlásit ";
        $insert = "INSERT INTO users (firstname, surname, email, password, adminRole) VALUES ('$jmeno','$prijmeni','$email','$heslo', $admin_value) ";
        echo $reg  ;
        $result = mysqli_query($conn, $insert);
        if (!$result) {
            die("Chyba v prikazu " . mysqli_error($conn));
        }
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online deníček</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="nas.php">O nás</a></li>
    <li><a href="proc.php">Proč</a></li>
    <li><a href="prihlaseni.php">Přihlášení</a></li>
    <li><a class="active" href="registrace.php">Registrace</a></li>
</ul>
<br>
<br>
<br>
<br>

<div class="registrace">
    <form method="post" action="registrace.php">
        <div class="registraceformular">
            <label for="jmeno">Jméno</label>
        </div>

        <input required type="text" id="jmeno" name="jmeno" placeholder="Zadej zde tvoje jméno">
        <br>
        <div class="registraceformular">
            <label for="prijmeni">Příjmení</label>
        </div>
        <input required type="text" id="prijmeni" name="prijmeni" placeholder="Zadej zde tvohe příjmení">
        <br>
        <div class="registraceformular">
            <label for="email">Email</label>
        </div>
        <input required type="email" id="email" name="email" placeholder="Zadej zde svůj email">
        <br>
        <div class="registraceformular">
            <label for="heslo">Heslo</label>
        </div>
        <input required type="password" id="heslo" name="heslo" placeholder="Zadej zde tvoje heslo">
        <br>
        <div class="registraceformular">
           <label for="adminhest">Admin Heslo</label>
        </div>
        <input type="password" id="adminheslo" name="adminheslo" placeholder="Zadej heslo pro Admina">
               <br>
        <?php if (isset($usedem)): ?>
            <h3 class="error-message"><?php echo $usedem?></h3>
        <?php endif; ?>

        <?php if (isset($reg)): ?>
            <h3 class="success-message"><?php echo $reg.'<a href="prihlaseni.php">Zde</a>'; ?></h3>
        <?php endif; ?>
        <input type="submit" id="ok" name="ok" placeholder="Registrovat se">
    </form>
</div>

</body>
</html>