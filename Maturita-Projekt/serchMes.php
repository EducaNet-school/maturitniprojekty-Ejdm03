<?php
$id = $_COOKIE["id"];
$idd=$_COOKIE["id_d"];
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// koukne zda tu neco je
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "SELECT messages.id_message, messages.description, messages.message, messages.date
FROM messages
JOIN m2d ON messages.id_message = m2d.id_m
WHERE m2d.id_d = '$id' AND (description LIKE '%$search%' OR message LIKE '%$search%' OR date LIKE '%$search%')";    $result = mysqli_query($conn, $query);
    echo'<div class="table-users">';

    echo '<table>';
    echo '<thead><tr><th>Popis</th><th>Text</th><th>Datum</th><th>Akce</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';

        echo '<td>' . $row["description"] . '</td>';
        echo '<td>' . substr($row["message"],0,50) . '</td>';
        echo '<td>' . $row["date"] . '</td>';
        echo '<td>';
        echo '<form method="post" action="showMes.php">';
        echo '<input type="hidden" name="id" value="' . $row['id_message'] . '">';
        echo '<button type="submit" class="button-18">Zobrazit</button>';
        echo '</form>';

        echo '<form method="post" action="editMes.php">';
        echo '<input type="hidden" name="id" value="' . $row['id_message'] . '">';
        echo '<button type="submit" class="button-18">Upravit</button>';
        echo '</form>';

        echo '<form id="deleteForm_' . $row['id_message'] . '" method="post" action="deleteD.php">';
        echo '<input type="hidden" name="id" value="' . $row['id_message'] . '">';
        echo '<button type="submit" class="button-delete" onclick="confirmDelete(\'' . $row["id_message"] . '\')">Smazat</button>';
        echo '</form>';


        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo'</div>';

    echo "<h1>Celkem: " . mysqli_num_rows($result) . " zápisky</h1>";
    exit;
}

// Close the connection
mysqli_close($conn);
?>
