<?php
$id = $_COOKIE["id"];
$idd=$_COOKIE["id_d"];

include "connection.php";
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
JOIN m2d ON messages.id_message = m2d.id_m
WHERE m2d.id_d = '$id'";
$result = mysqli_query($conn, $sql);



if (isset($_POST['from']) && isset($_POST['to'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $sql .= " AND DATE(messages.date) >= '$from' AND DATE(messages.date) <= '$to'";

}

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
<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="$">OnlineD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="denikDash.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Přehled zápisků</span></span></a>
            <a href="profile.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Správa údajů</span></span></a>
            <a href="findMes.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Hledat zápisky</span></span></a>
            <a href="addMes.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Přidat zápisek</span></span></a>
            <a href="logout.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Odhlásit se</span></span></a>

        </div>
    </nav>
</header>

<br>
<br>
<br>



<h1>Název tvého deníku je : <?php echo $diaryName; ?></h1>

<form action="denikDash.php" method="post">
    <div class="form-group">
        <div class="form-label">From:</div>
        <div class="form-input">
            <input type="date" id="from" name="from">
        </div>
    </div>
    <div class="form-group">
        <div class="form-label">To:</div>
        <div class="form-input">
            <input type="date" id="to" name="to">
        </div>
    </div>
    <div class="form-group">

        <div class="Mall">
            <a href="denikDash.php">Zobrazit vše</a>
        </div>
        <div class="form-input">
            <input type="submit" value="Filter">
        </div>
    </div>
</form>

<h1>Tvoje zápisky</h1>

<table>
    <tr>
        <th>Popis</th>
        <th>Datum vytvoření</th>
        <th>Actions</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <a href="showMes.php?id=<?php echo $row['id_message'];?>">Show</a>
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