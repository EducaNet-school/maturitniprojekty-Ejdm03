<?php
include "connection.php";



// potvrzeni
if (isset($_POST['ok'])) {
    // Get the form data
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];
    // pripojeni do db
    // kontrola
    $query = "SELECT * FROM users WHERE email='$email' AND password='$heslo'";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_assoc($result);



    if (mysqli_num_rows($result) == 1) {

        if ($row["Block"] == 1) {
            header('Location: Banned.php');
        }
        // check if user is admin
        elseif ($row["adminRole"] == 1) {
            setcookie("id",$row["id"]);
            header('Location: Admindashboard.php');
        } elseif ($row["adminRole"] == 0) {
            setcookie("id",$row["id"]);
            header('Location: denicek.php');
        }
    }
    else {
        // neco nesedi , vypise
        $error = "Email nebo Heslo nesedí. Zkus to znovu.";
    }

    // zavre pripojeni
    mysqli_close($conn);

}


if (isset($_POST['reset'])) {
    $email = $_POST['reset_email'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        // Generate password reset link and send email
        $reset_link = generateResetLink($email);
        sendPasswordResetEmail($email, $reset_link);
        $success = "A password reset link has been sent to your email.";
    } else {
        $error = "The email address is not associated with any account.";
    }
    mysqli_close($conn);
}

// Function to generate password reset link
function generateResetLink($email) {
    // Generate a unique reset token
    $reset_token = bin2hex(random_bytes(16));
    // Save the reset token and expiry date




}
?>






<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online deníček</title>
    <link rel="stylesheet" href="styltest.css">


</head>
<body class="login">
<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="index.php">OnlineD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="index.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Domů</span></span></a>
            <a href="prihlaseni.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Přihlášení</span></span></a>
            <a href="registrace.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Registrace</span></span></a>

        </div>
    </nav>
</header>



<br>
<br>
<br>
<br>

<div class="form-login">
    <div class="title">Přihlášení</div>

    <form method="post" action="prihlaseni.php">

        <div class="input-container ic1">
            <input id="email" class="input" type="email" name="email" placeholder=" " required/>
            <div class="cut"></div>
            <label for="email" class="placeholder">Email</label>
        </div>
        <div class="input-container ic2">
            <input id="heslo" class="input" type="password" name="heslo" placeholder=" " required/>
            <div class="cut"></div>
            <label for="heslo" class="placeholder">Heslo</label>
        </div>
        <div class="resetB">
            <a href="resetpassword.php">Zapomněl jsi heslo?</a>
        </div>
        <?php if (isset($error)): ?>
            <h3 class="error-message"><?php echo $error; ?></h3>
        <?php endif; ?>
        <button type="submit" class="submit" name="ok">Přihlásit se</button>
    </form>
</div>







</body>
</html>