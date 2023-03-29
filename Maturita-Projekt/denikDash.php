<?php
$id = $_COOKIE["id"];
$diaryName = '';
$messages = array();

include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Výběr jména deníku z tabulky "denik", kde "idd" = "$id"
$query_diary = "SELECT jmeno FROM denik WHERE idd = ?";
$stmt_diary = mysqli_prepare($conn, $query_diary);
mysqli_stmt_bind_param($stmt_diary, "i", $id);
mysqli_stmt_execute($stmt_diary);
$result_diary = mysqli_stmt_get_result($stmt_diary);

if (mysqli_num_rows($result_diary) > 0) {
    $row_diary = mysqli_fetch_assoc($result_diary);
    $diaryName = $row_diary["jmeno"];
}

// Výběr zpráv z tabulky "messages", kde "id_d" = "$id" pomocí join s tabulkou "M2D"
$query_messages = "SELECT messages.id_message, messages.description, messages.date FROM messages JOIN m2d ON messages.id_message = m2d.id_m WHERE m2d.id_d = ?";
$condition_query = " AND DATE(messages.date) >= ? AND DATE(messages.date) <= ?";
//nastaveni filtru kontrola
if (isset($_POST['from'], $_POST['to'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $query_messages .= $condition_query;
    $stmt_messages = mysqli_prepare($conn, $query_messages);
    mysqli_stmt_bind_param($stmt_messages, "iss", $id, $from, $to);
} else {
    $stmt_messages = mysqli_prepare($conn, $query_messages);
    mysqli_stmt_bind_param($stmt_messages, "i", $id);
}

mysqli_stmt_execute($stmt_messages);
$result_messages = mysqli_stmt_get_result($stmt_messages);

if (mysqli_num_rows($result_messages) > 0) {
    while ($row_messages = mysqli_fetch_assoc($result_messages)) {
        $messages[] = $row_messages;
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
    <title>Vkladani</title>
    <link rel="stylesheet" href="styltest.css">
</head>
<body class="edit-body">
<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="">OnlineD</a></h1>
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



<div class="admin-nadpis">Název tvého deníku je : <?php echo $diaryName; ?></div>

<form action="denikDash.php" method="post">
    <div class="form-group">
        <div class="form-label">Od:</div>
        <div class="form-input">
            <input type="date" id="from" name="from">
        </div>
    </div>
    <div class="form-group">
        <div class="form-label">Do:</div>
        <div class="form-input">
            <input type="date" id="to" name="to">
        </div>
    </div>
    <div class="form-group">

        <div>
            <a href="denikDash.php" class="D-vse">Zobrazit vše</a>
        </div>
        <div class="filtr">
            <input class="filtr-button" type="submit" value="Filtruj">
        </div>
    </div>
</form>

<div class="table-zapisky">
    <span   class="admin-nadpis">Tvoje zápisky:</span>

    <div class="inner-containertab">


    <table>
    <tr>
        <th>Popis</th>
        <th>Datum vytvoření</th>
        <th>Akce</th>
    </tr>
        <?php foreach ($messages as $message): ?>
        <tr>
            <td><?php echo $message['description']; ?></td>
            <td><?php echo $message['date']; ?></td>
            <td>
                <form method="post" action="showMes.php">
                    <input type="hidden" name="id" value="<?php echo $message['id_message']; ?>">
                    <button type="submit" class="button-18">Zobrazit</button>
                </form>
                <form method="post" action="editMes.php">
                    <input type="hidden" name="id" value="<?php echo $message['id_message']; ?>">
                    <button type="submit" class="button-18">Upravit</button>
                </form>
                <form id="deleteForm_<?php echo $message['id_message']; ?>" method="post" action="deleteD.php">
                    <input type="hidden" name="id" value="<?php echo $message['id_message']; ?>">
                    <button type="submit" class="button-delete" onclick="confirmDelete('<?php echo $message["id_message"]; ?>')">Smazat</button>
                </form>

            </td>
        </tr>
        <?php endforeach; ?>
</table>
</div>
</div>

</body>
<script>
    function confirmDelete(id) {
        var confirmDelete = confirm("Opravdu cheš vymazat tento zápisek?");
        if (confirmDelete == true) {
            window.location.replace("deleteD.php?id=" + id);
        } else {
            event.preventDefault();
            return false;
        }
    }
</script>

</html>