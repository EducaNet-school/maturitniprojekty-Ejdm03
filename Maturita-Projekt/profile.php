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

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = (int)$_GET["id"];
    }
if ($id) {
    // Select the user with the given ID
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM denik WHERE idd=$id";
    $result1 = mysqli_query($conn, $sql1);


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
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $dname=mysqli_real_escape_string($conn,$_POST["dname"]);


    // Update the user with the given ID
    $sql = "UPDATE users SET firstname = '$name', surname = '$surname', email = '$email', password = '$password' WHERE id = $id";
    mysqli_query($conn, $sql);

    $sql1 ="UPDATE denik SET jmeno='$dname' WHERE idd = $id";
    mysqli_query($conn, $sql1);


    header("Location: denikDash.php");
    exit();
}

mysqli_close($conn);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
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
            <a href="denikDash.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Zp??t</span></span></a>
        </div>
    </nav>
</header>






<div class="mes-container">

    <div class="title">Upravit ??daje</div>


    <form action="profile.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-container ic1">
            <input class="input" type="text" name="name" id="name" required value="<?php echo $name; ?>">
            <div class="cut"></div>
         <label for="name" class="placeholder">Jm??no</label>
        </div>


        <div class="input-container ic2">
            <input class="input" type="text" name="surname" id="surname" required value="<?php echo $surname; ?>">
            <div class="cut"></div>
            <label for="surname" class="placeholder">P????jmen??</label>

        </div>

        <div class="input-container ic2">
            <input class="input" type="email" name="email" id="email" required value="<?php echo $email; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="email">E-mail</label>

        </div>

        <div class="input-container ic2">
            <input class="input" type="password" name="password" id="password" required value="<?php echo $password; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="password">Heslo</label>
        </div>

        <input type="checkbox" onclick="myFunction()"> Show Password

        <div class="input-container ic2">
            <input class="input" type="text" name="dname" id="dname" required value="<?php echo $dname; ?>">
            <div class="cut"></div>
            <label class="placeholder" for="dname">D n??zev</label>
        </div>

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


