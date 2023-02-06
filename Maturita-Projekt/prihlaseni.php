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
        echo $error;
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
    <link rel="stylesheet" href="styl.css">


</head>
<body>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="nas.php">O nás</a></li>
    <li><a href="proc.php">Proč</a></li>
    <li><a class="active"  href="prihlaseni.php">Přihlášení</a></li>
    <li><a href="registrace.php">Registrace</a></li>
</ul>

<br>
<br>
<br>
<br>




<div class="registrace">
    <form method="post" action="prihlaseni.php">
        <div class="registraceformula">
            <label for="email">Email</label>
        </div>
        <input type="email" id="email" name="email" placeholder="Zadej zde tvůj email">
        <br>
        <div class="registraceformula">
            <label for="heslo">Heslo</label>
        </div>
        <input type="password" id="heslo" name="heslo" placeholder="Zadej zde tvoje heslo">
        <br>
        <?php if (isset($error)): ?>
            <h3 class="error-message"><?php echo $error; ?></h3>
        <?php endif; ?>

        <div class="resetB">
        <a href="resetpassword.php">Reset password</a>
        </div>

        <input type="submit" id="ok" name="ok" placeholder="Přihlásit se">
    </form>
</div>





</body>
</html>