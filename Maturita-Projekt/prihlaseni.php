<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";




// potvrzeni
if (isset($_POST['ok'])) {
    // Get the form data
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];




    // pripojeni do db
    $dbb = mysqli_connect($servername, $username, $password, $db);

    // kontrola
    $query = "SELECT * FROM users WHERE email='$email' AND password='$heslo'";

    $result = mysqli_query($dbb, $query);
    $row=mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        // check if user is admin
        if ($row["adminRole"] == 1) {
            setcookie("id",$row["id"]);
            header('Location: Admindashboard.php');
        } else {
            setcookie("id",$row["id"]);
            header('Location: denicek.php');
        }
    } else {
        // neco nesedi , vypise
        $error = "Email nebo Heslo nesedí. Zkus to znovu.";
    }

    // zavre pripojeni
    mysqli_close($dbb);
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
    <li><a class="active"  href="prihlaseni.php">Přihlášení</a></li>
    <li><a href="registrace.php">Registrace</a></li>
</ul>

<br>
<br>
<br>
<br>




<div class="registrace">
    <form method="post" action="prihlaseni.php">
        <div class="registraceformula">
            <label for="email">Email</label>
        </div>
        <input type="email" id="email" name="email" placeholder="Zadej zde tvůj email">
        <br>
        <div class="registraceformula">
            <label for="heslo">Heslo</label>
        </div>
        <input type="password" id="heslo" name="heslo" placeholder="Zadej zde tvoje heslo">
        <br>
        <input type="submit" id="ok" name="ok" placeholder="Přihlásit se">
    </form>
</div>





</body>
</html>