<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = isset($_COOKIE["id"]) ? (int)$_COOKIE["id"] : null;
$name = '';
$surname = '';
$email = '';
$password = '';
$dname="";

if ($id) {
    // vybere uzivatele
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $sql1 = "SELECT * FROM denik WHERE idd=?";
    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "i", $id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row["firstname"];
        $surname = $row["surname"];
        $email = $row["email"];
        $password = $row["password"];
    } else {
        echo "User with id $id not found in the database.";
    }

    if (mysqli_num_rows($result1) > 0) {
        $roww = mysqli_fetch_assoc($result1);
        $dname = $roww["jmeno"];
    } else {
        echo "Denik s ID $id nenalezen";
    }
}

if (isset($_POST["submit"]) && !empty($_POST["id"])) {
    $id = (int)$_POST["id"];
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
    $email = $_POST['email'];
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $dname = mysqli_real_escape_string($conn, $_POST["dname"]);

    $query = "SELECT * FROM users WHERE email=? AND id != ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "si", $email, $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        $email_error = "Tento email už někdo má, zkus jiný.";
    } else {
        $sql = "UPDATE users SET firstname = ?, surname = ?, email = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $surname, $email, $password, $id);
        mysqli_stmt_execute($stmt);

        $sql1 ="UPDATE denik SET jmeno=? WHERE idd = ?";
        $stmt1 = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "si", $dname, $id);
        mysqli_stmt_execute($stmt1);

        if($stmt1){
            $success = "Data upravena.";
        }else{
            $errorek="Data nebyla upraveny";
        }



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
    <title>Úprava profilu</title>
    <link rel="stylesheet" href="styltest.css">
</head>
<body class="show-mes-body">

<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="">OnlineD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="denikDash.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Zpět</span></span></a>
        </div>
    </nav>
</header>






<div class="mes-container">

    <div class="title">Upravit údaje</div>


    <form action="profile.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-container ic1">
            <input class="input" type="text" name="name" id="name" required value="<?php echo $name; ?>">
            <div class="cut"></div>
         <label for="name" class="placeholder">Jméno:</label>
        </div>


        <div class="input-container ic2">
            <input class="input" type="text" name="surname" id="surname" required value="<?php echo $surname; ?>">
            <div class="cut"></div>
            <label for="surname" class="placeholder">Příjmení:</label>

        </div>

        <div class="input-container ic2">
            <input class="input" type="email" name="email" id="email" required value="<?php echo $email; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="email">E-mail:</label>
        </div>


        <?php if(isset($email_error)) { ?>
            <span class="error"><?php echo $email_error; ?></span>
        <?php } ?>



        <div class="input-container ic2">
            <input class="input" type="password" name="password" id="password" required value="<?php echo $password; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="password">Heslo:</label>
        </div>

        <input type="checkbox" onclick="myFunction()"> <span class="showp">Zobrazit heslo</span>

        <div class="input-container ic2">
            <input class="input" type="text" name="dname" id="dname" required value="<?php echo $dname; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="dname">Název deníku:</label>
        </div>

        <?php if(isset($success)) { ?>
            <span class="okedit"><?php echo $success; ?></span>
        <?php } ?>
        <?php if(isset($errorek)) { ?>
            <span class="error"><?php echo $errorek; ?></span>
        <?php } ?>



        <button type="submit" value="submit" class="submit" name="submit">Upravit</button>

</form>
</div>
</body>
<script>

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>
</html>
