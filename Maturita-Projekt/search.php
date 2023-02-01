<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Checke jestli tam neco je
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "SELECT * FROM users WHERE firstname LIKE '%$search%' OR surname LIKE '%$search%' OR email LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

    echo '<table>';
    echo '<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Admin Role</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row["adminRole"] == 0) {
            $adminRole = "User";
        } else if ($row["adminRole"] == 1) {
            $adminRole = "Admin";
        }
        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["firstname"] . '</td>';
        echo '<td>' . $row["surname"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td>' . $adminRole . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    exit;
}

// Konec spojeni
mysqli_close($conn);
?>
