<?php

//
$id = $_COOKIE["id"];

// pripojeni do db
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// odeslani
if (isset($_POST["odeslat"])) {
    //vezme nazev deniku z
    $diary_name = mysqli_real_escape_string($conn, $_POST["diary_name"]);

    // vlozi nazev
    $sql = "INSERT INTO denik (idd, jmeno) VALUES ('$id', '$diary_name')";
    mysqli_query($conn, $sql);

    // vloz id_u a id_d values into  u2d table
    $sql = "INSERT INTO u2d (id_u, id_d) VALUES ('$id', '$id')";
    mysqli_query($conn, $sql);

    // presmeruj to the denikDash.php
    header("Location: denikDash.php");
    exit;
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
    <title>Give Your Diary a Name</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<h1>Dej svému deníku jméno</h1>

<div class="registrace">

<form action="dname.php" method="post">
    <div class="registraceformula">
    <label for="diary_name">Název deníku:</label>
    </div>
    <input type="text" id="diary_name" name="diary_name">
    <input type="submit" name="odeslat" placeholder="Vloz název">
</form>
</div>
</body>
</html>
