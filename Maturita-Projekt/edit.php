<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//cte data
$id = $_POST['id']; // Use POST instead of GET
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $id = (int)$_POST["id"];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $adminRole = $_POST['adminRole'];

    // check if email already exists
    $query = "SELECT * FROM users WHERE email='$email' AND id != $id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $email_error = "Tento email už někdo má, zkus jiný.";
    } else {
        // update user data
        $query = "UPDATE users SET firstname='$firstname', surname='$surname', email='$email', adminRole='$adminRole' WHERE id = $id";
        mysqli_query($conn, $query);

        if ($query){
            $okedit ="Data upravena.";
        }
    }
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

<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="">OnlineD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="AdminDashboard.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Zpět</span></span></a>
        </div>
    </nav>
</header>

<div class="mes-container">

    <div class="title">Upravit údaje</div>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="input-container ic1">
            <input class="input" id="firstname" type="text" name="firstname" value="<?php echo $row['firstname']; ?>">
            <div class="cut"></div>
            <label for="firstname" class="placeholder">Jméno:</label>
        </div>

        <div class="input-container ic2">
            <input class="input" id="surname" type="text" name="surname" value="<?php echo $row['surname']; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="surname">Příjmení:</label>

        </div>

        <div class="input-container ic2">
            <input class="input" id="email" type="email" name="email" value="<?php echo $row['email']; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="email">E-mail:</label>
            <?php if(isset($email_error)) { ?>
                <span class="error"><?php echo $email_error; ?></span>
            <?php } ?>

        </div>

        <div class="input-container ic2">
            <select class="input" id="admin" name="adminRole">
                <option value="0" <?php if($row['adminRole'] == 0) { echo 'selected'; } ?>>Uživatel</option>
                <option value="1" <?php if($row['adminRole'] == 1) { echo 'selected'; } ?>>Admin</option>
            </select>
            <div class="cut"></div>
            <label class="placeholder" for="admin">Role:</label>
        </div>

        <?php if(isset($okedit)) { ?>
            <span class="okedit"><?php echo $okedit; ?></span>
        <?php } ?>

        <button type="submit" value="submit" class="submit" name="submit">Upravit</button>
    </form>
</div>
</body>
</html>