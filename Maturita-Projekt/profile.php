<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_COOKIE["id"];
$name = '';
$surname = '';
$email = '';
$password = '';
$dname="";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = (int)$_GET["id"];

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
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<nav>
    <a href="denikDash.php">Zpět</a>
</nav>
<h1>Edit User</h1>
<form action="profile.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required value="<?php echo $name; ?>">
    </div>
    <div>
        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname" required value="<?php echo $surname; ?>">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required value="<?php echo $email; ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required value="<?php echo $password; ?>">
    </div>
    <input type="checkbox" onclick="myFunction()">Show Password

    <div>
    <label for="dname">Název Deníčku</label>
    <input type="text" name="dname" id="dname" required value="<?php echo $dname; ?>"
</div>

    <div>
        <input type="submit" name="submit" value="Save">
    </div>
</form>
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


