<?php
$id = $_COOKIE["id"];

$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Výběr jména deníku z tabulky "denik", kde "idd" = "$id"
$sql = "SELECT jmeno FROM denik WHERE idd = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $diaryName = $row["jmeno"];
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
    <title>Vkladani</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="logout.php">Logout</a>
</nav>


<h1>Název tvého deníku je : <?php echo $diaryName; ?></h1>
<!-- Dál pokračovat s vkládaním zípisku potrebva udelat databazi-->
</body>
</html>
