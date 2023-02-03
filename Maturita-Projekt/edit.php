<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//cte data
$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $adminRole = $_POST['adminRole'];

    $query = "UPDATE users SET firstname='$firstname', surname='$surname', email='$email', adminRole='$adminRole' WHERE id = $id";
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
<form method="post">
    <label>Name:</label>
    <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>">
    <br>
    <label>Surname:</label>
    <input type="text" name="surname" value="<?php echo $row['surname']; ?>">
    <br>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>">
    <br>
    <label>Admin Role:</label>
    <select name="adminRole">
        <option value="0" <?php if($row['adminRole'] == 0) { echo 'selected'; } ?>>User</option>
        <option value="1" <?php if($row['adminRole'] == 1) { echo 'selected'; } ?>>Admin</option>
    </select>
    <br>
    <input type="submit" value="Update">
</form>
</body>
</html>