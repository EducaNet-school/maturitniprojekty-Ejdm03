<?php

//
$id = $_COOKIE["id"];

include "connection.php";
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
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Přiřaď název deníku</title>
    <link rel="stylesheet" href="styltest.css">
</head>
<body class="show-mes-body">


<div class="mes-container">
    <div class="title">Dej svému deníku jméno</div>


<form action="dname.php" method="post">
    <div class="input-container ic2">
        <input type="text" id="diary_name" name="diary_name" class="input" required>
        <div class="cut"></div>
        <label class="placeholder" for="diary_name">Název deníku:</label>

    </div>

    <input type="submit" name="odeslat" class="submit" value="Přiřadit jméno">


</form>
</div>


</body>
</html>
