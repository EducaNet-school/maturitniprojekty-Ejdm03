<?php

$id = $_COOKIE["id"];

include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//vyber from u2d kde id_u = $id
$sql = "SELECT id_d FROM u2d WHERE id_u = '$id'";
$result = mysqli_query($conn, $sql);

//jestli to neco vrati
if (mysqli_num_rows($result) > 0) {
    //jestli tam neco je uloz id deniku
    $row = mysqli_fetch_assoc($result);
    setcookie("id_d", $row["id_d"]);

    //jestli tu neco je prehod na
    header("Location: denikDash.php");
} else {
    //pokud tu nic neni prehod na
    header("Location: dname.php");
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
    <title>Document</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

</body>
</html>
