<?php


// Include the required PHPMailer files
require 'E:\maturitniprojekty-Ejdm03\PHPMailer\src\Exception.php';
require 'E:\maturitniprojekty-Ejdm03\PHPMailer\src\PHPMailer.php';
require 'E:\maturitniprojekty-Ejdm03\PHPMailer\src\SMTP.php';

include "connection.php";

if (isset($_POST['reset'])) {
    // Get the email from the form
    $email = $_POST['email'];

    // pripojeni do db

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Generate a new password
        $new_password = substr(md5(rand()), 0, 7);
        // Update the password in the database
        $update_query = "UPDATE users SET password='$new_password' WHERE email='$email'";
        mysqli_query($conn, $update_query);
        // Send an email with the new password to the user
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'onlinedenicek@gmail.com';
        $mail->Password = 'ujvfojzlvztrecew';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('info@onlined.com', 'Onlined');
        $mail->addAddress($email);
        $mail->Subject = 'Password reset';
        $mail->Body = "Tvé nové heslo je: " . $new_password;
        $mail->send();


        echo "<div id='loader'>
    <div class='loader'></div>
</div>";
        echo "<h1>Heslo bylo resetováno a bylo posláno na tvůj email.</h1>";
        header("Refresh: 6; url=prihlaseni.php");


    } else {

        echo "<div id='loader'>
    <div class='loader'></div>
</div>";
        echo "<h1>Email neexistuje v naší databázi.</h1>";
        header("Refresh: 6; url=prihlaseni.php");
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset hesla</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
<h2>Reset hesla</h2>


<form method="post" action="resetpassword.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Zadej svůj email">
    <br><br>
    <input type="submit" name="reset" value="Resetovat heslo">
</form>
</body>
</html>
