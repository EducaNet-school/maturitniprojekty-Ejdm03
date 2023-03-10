<?php
include "connection.php";
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
    $block= $_POST['ban'];


        // update user data
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
    <link rel="stylesheet" href="styltest.css">
</head>
<body class="edit-body">

<div class="mes-container">

    <div class="title">Upravit údaje</div>

    <form method="post">

        <div class="input-container ic1">
            <input class="input" id="firstname" type="text" name="firstname" readonly value="<?php echo $row['firstname']; ?>">
            <div class="cut"></div>
            <label for="firstname" class="placeholder">Jméno:</label>
        </div>

        <div class="input-container ic2">
            <input class="input" id="surname" type="text" name="surname" readonly value="<?php echo $row['surname']; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="surname">Příjmení:</label>

        </div>

        <div class="input-container ic2">
            <input class="input" id="email" type="email" name="email" readonly value="<?php echo $row['email']; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="email">E-mail:</label>

        </div>

        <div class="input-container ic2">
            <input class="input" id="adminRole" type="text" name="adminRole" readonly value="<?php echo ($row['adminRole'] == 0) ? 'User' : 'Admin'; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="admin">Role:</label>
        </div>


        <div class="input-container ic2">
            <select name="ban" class="input">
                <option  value="0" <?php if($row['adminRole'] == "No") { echo 'selected'; } ?>>Odblokovat</option>
                <option  value="1" <?php if($row['adminRole'] == "Yes") { echo 'selected'; } ?>>Zablokovat</option>
            </select>
        </div>





        <button type="submit" value="submit" class="submit" name="submit">Upravit</button>
    </form>
</div>
</body>
</html>