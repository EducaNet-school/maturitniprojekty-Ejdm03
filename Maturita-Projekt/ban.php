<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetch data from users table
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $adminRole = $_POST['adminRole'];
    $block= $_POST['ban'];

    $query = "UPDATE users SET Block='$block' WHERE id = $id";
    mysqli_query($conn, $query);
    header("location:AdminDashboard.php");
}

?>
<!doctype html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<h1>Edit User</h1>
<table>
    <<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Admin Role</th>
        <th>Ban</th>
    </tr
    <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["firstname"]; ?></td>
        <td><?php echo $row["surname"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo ($row["adminRole"] == 0) ? "User" : "Admin"; ?></td>
        <td><?php echo ($row["Block"] == 0) ? "No" : "Banned"; ?></td>
    </tr>
</table>
<br>
<form method="post">
    <select name="ban">
        <option value="0" <?php if($row['adminRole'] == "No") { echo 'selected'; } ?>>Odblokovat</option>
        <option value="1" <?php if($row['adminRole'] == "Yes") { echo 'selected'; } ?>>Zablokovat</option>
    </select>
    <br><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
