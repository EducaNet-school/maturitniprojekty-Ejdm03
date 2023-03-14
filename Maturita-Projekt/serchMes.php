<?php
$id = $_COOKIE["id"];
$idd=$_COOKIE["id_d"];
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if there is anything in the search field
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "SELECT messages.id_message, messages.description, messages.message, messages.date
FROM messages
JOIN m2d ON messages.id_message = m2d.id_m
WHERE m2d.id_d = '$id' AND (description LIKE '%$search%' OR message LIKE '%$search%' OR date LIKE '%$search%')";    $result = mysqli_query($conn, $query);

    echo '<table>';
    echo '<thead><tr><th>Popis</th><th>Text</th><th>Datum</th><th>Akce</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';

        echo '<td>' . $row["description"] . '</td>';
        echo '<td>' . substr($row["message"],0,50) . '</td>';
        echo '<td>' . $row["date"] . '</td>';
        echo '<td>';
        echo '<a class="D-akce" href="showMes.php?id=' . $row["id_message"].'">Show </a>';
        echo '<a class="D-akce" href="editMes.php?id=' . $row["id_message"] . '">Edit </a>';
        echo '<a class="D-akce" href="#" onclick="confirmDelete(' . $row["id_message"] . ');">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo "<h1>Total " . mysqli_num_rows($result) . " Messages</h1>";
    exit;
}

// Close the connection
mysqli_close($conn);
?>
