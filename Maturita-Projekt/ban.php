<?php
include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$query = "SELECT id, firstname, surname, email, adminRole, Block FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $id = (int)$_POST["id"];
    $block = $_POST['ban'];

    $query = "UPDATE users SET Block = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $block, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
        $ok_message = "Změny proběhly v pořádku";
    } else{
        $error_message = "Něco se pokazilo";
    }
}

mysqli_close($conn);
?>
<!doctype html>
<html lang="cs">
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

    <div class="title">Blokace účtu</div>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

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
            <input class="input" id="adminRole" type="text" name="adminRole" readonly value="<?php echo ($row['adminRole'] == 0) ? 'Uživatel' : 'Admin'; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="admin">Role:</label>
        </div>


        <div class="input-container ic2">
            <select id ="ban" name="ban" class="input">
                <option  value="0" <?php if($row['adminRole'] == "No") { echo 'selected'; } ?>>Odblokovat</option>
                <option  value="1" <?php if($row['adminRole'] == "Yes") { echo 'selected'; } ?>>Zablokovat</option>
            </select>
            <div class="cut"></div>

            <label class="placeholder" for="ban">Blokace:</label>

        </div>

        <?php if(isset($ok_message)) { ?>
            <span class="okedit"><?php echo $ok_message; ?></span>
        <?php } ?>

        <?php if(isset($error_message)) { ?>
            <span class="error"><?php echo $error_message; ?></span>
        <?php } ?>



        <button type="submit" value="submit" class="submit" name="submit">Upravit</button>
    </form>
</div>
</body>
</html>