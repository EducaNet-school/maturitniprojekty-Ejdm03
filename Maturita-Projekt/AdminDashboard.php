<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetch data from users table
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

?>
<!doctype html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminDashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<h1>Admin Dashboard</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Admin Role</th>
        <th>Actions</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) {
    if ($row["adminRole"] == 0) {
        $adminRole = "User";
    } else if ($row["adminRole"] == 1) {
        $adminRole = "Admin";
    }
    ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["surname"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $adminRole; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>