<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//cte data
$id = $_POST['id'];
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);


// cte data z formulare
if (isset($_POST["submit"])) {
    $id = (int)$_POST["id"];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $adminRole = $_POST['adminRole'];
    $block= $_POST['ban'];


        // updatuje data
        $query = "UPDATE users SET Block='$block' WHERE id = $id";
        mysqli_query($conn, $query);

        if ($query){
            $ok = "Změny proběhly v pořádku";
        } else{
            $ne = "Něco se pokazilo";
        }


    }

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

        <?php if(isset($ok)) { ?>
            <span class="okedit"><?php echo $ok; ?></span>
        <?php } ?>

        <?php if(isset($ne)) { ?>
            <span class="error"><?php echo $ne; ?></span>
        <?php } ?>



        <button type="submit" value="submit" class="submit" name="submit">Upravit</button>
    </form>
</div>
</body>
</html>