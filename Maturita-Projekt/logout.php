<?php
session_start();
// odstrani cookie
if(isset($_COOKIE['id'])) {
    unset($_COOKIE['id']);
    setcookie("id", "", time() - 3600, "/");

}

session_destroy();
header("Location: prihlaseni.php");
exit();
?>
