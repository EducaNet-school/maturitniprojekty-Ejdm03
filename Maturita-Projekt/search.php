<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Checke jestli tam neco je
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "SELECT * FROM users WHERE firstname LIKE '%$search%' OR surname LIKE '%$search%' OR email LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

    echo '<table>';
    echo '<thead><tr><th>ID</th><th>Jméno</th><th>Příjmení</th><th>Email</th><th>Admin Role</th><th>Ban</th><th>Akce</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["adminRole"] == 0) {
            $adminRole = "User";
        } else if ($row["adminRole"] == 1) {
            $adminRole = "Admin";
        }

        if($row["Block"]==0){
            $userBlock = "No";
        }elseif ($row["Block"]==1){
            $userBlock ="Banned";
        }

        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["firstname"] . '</td>';
        echo '<td>' . $row["surname"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td>' . $adminRole . '</td>';
        echo '<td>' . $userBlock.'</td>';
        echo '<td>';
        echo '<a href="edit.php?id=' . $row["id"] . '">Edit </a>';
        echo '<a href="ban.php?id=' . $row["id"] . '">Ban </a>';
        echo '<a href="#" onclick="confirmDelete(' . $row["id"] . ');">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo "<h1>Celkem " . mysqli_num_rows($result) . " Uživatelé</h1>";
    exit;
}

// Konec spojeni
mysqli_close($conn);
?>

