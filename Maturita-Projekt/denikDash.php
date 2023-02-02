<?php
$id = $_COOKIE["id"];
$idd=$_COOKIE["id_d"];

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

//Výběr zpráv z tabulky "messages", kde "id_d" = "$id" pomocí join s tabulkou "M2D"
$sql = "SELECT messages.id_message, messages.description, messages.date FROM messages
JOIN M2D ON messages.id_message = M2D.id_m
WHERE M2D.id_d = '$id'";
$result = mysqli_query($conn, $sql);

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
    <a href="addMes.php">Add message</a>
</nav>
<h1>Název tvého deníku je : <?php echo $diaryName; ?></h1>
<table>
    <tr>
        <th>Popis</th>
        <th>Datum</th>
        <th>Actions</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <a href="editMes.php?id=<?php echo $row["id_message"]; ?>">Edit</a>
                <a href="#" onclick="confirmDelete(<?php echo $row["id_message"]; ?>)">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
<script>
    function confirmDelete(id) {
        var confirmDelete = confirm("Are you sure you want to delete this user?");
        if (confirmDelete == true) {
            window.location.replace("deleteD.php?id=" + id);
        } else {
            return false;
        }
    }
</script>

</html>