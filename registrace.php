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
<form method="post" action="post">
    <label for="jmeno">Jméno</label>
    <input type="text" id="jmeno" name="jmeno" placeholder="Zadej zde tvoje jméno">
    <br>
    <label for="prijmeni">Příjmení</label>
    <input type="text" id="prijmeni" name="prijmeni" placeholder="Zadej zde tvohe příjmení">
    <br>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Zadej zde svůj email">
    <br>
    <label for="heslo">Heslo</label>
    <input type="password" id="heslo" name="heslo" placeholder="Zadej zde tvoje heslo">
    <br>
    <input type="submit" id="ok" name="ok" placeholder="Registrovat se">
</form>
</div>

</body>
</html>
