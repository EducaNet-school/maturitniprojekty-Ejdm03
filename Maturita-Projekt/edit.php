<?php
include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = 0; //initialize the $id variable with a default value

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
}

if (isset($_POST["submit"])) {
    $id = intval($_POST["id"]);
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $adminRole = $_POST['adminRole'];

    // kontrola zda email existuje
    $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? AND id != ?");
    mysqli_stmt_bind_param($stmt, "si", $email, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $email_error = "Tento email už někdo má, zkus jiný.";
    } else {
        // Update user data
        $stmt = mysqli_prepare($conn, "UPDATE users SET firstname = ?, surname = ?, email = ?, adminRole = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "ssssi", $firstname, $surname, $email, $adminRole, $id);
        mysqli_stmt_execute($stmt);

        if ($stmt) {
            $okedit = "Data upravena.";
        }else{
            $errorek = "Data nebyla upravena";
        }
    }
}

//Fetchne user data
$stmt = mysqli_prepare($conn, "SELECT firstname, surname, email, adminRole FROM users WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $firstname, $surname, $email, $adminRole);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

mysqli_close($conn);
?>

<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upravit uživatele</title>
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
            <input class="input" id="firstname" type="text" name="firstname" value="<?php echo $firstname; ?>">
            <div class="cut"></div>
            <label for="firstname" class="placeholder">Jméno:</label>
        </div>

        <div class="input-container ic2">
            <input class="input" id="surname" type="text" name="surname" value="<?php echo $surname; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="surname">Příjmení:</label>

        </div>

        <div class="input-container ic2">
            <input class="input" id="email" type="email" name="email" value="<?php echo $email; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="email">E-mail:</label>
            <?php if(isset($email_error)) { ?>
                <span class="error"><?php echo $email_error; ?></span>
            <?php } ?>

        </div>

        <div class="input-container ic2">
            <select class="input" id="admin" name="adminRole">
                <option value="0" <?php if($adminRole == 0) { echo 'selected'; } ?>>Uživatel</option>
                <option value="1" <?php if($adminRole == 1) { echo 'selected'; } ?>>Admin</option>
            </select>
            <div class="cut"></div>
            <label class="placeholder" for="admin">Role:</label>
        </div>

        <?php if(isset($okedit)) { ?>
            <span class="okedit"><?php echo $okedit; ?></span>
        <?php } ?>

        <?php if(isset($errorek)) { ?>
            <span class="error"><?php echo $errorek; ?></span>
        <?php } ?>
        <button type="submit" value="submit" class="submit" name="submit">Upravit</button>
    </form>
</div>
</body>
</html>