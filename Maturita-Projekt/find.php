<?php
include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetchne data
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hledání uživatelů</title>
    <link rel="stylesheet" href="styltest.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            $("#search").keyup(function(){
                var searchTerm = $(this).val();
                if (searchTerm != "") {
                    $.ajax({
                        type: 'post',
                        url: 'search.php',
                        data: {
                            search: searchTerm
                        },
                        success: function (response) {
                            $("#result").html(response);
                        }
                    });
                } else {
                    $("#result").html("");
                }
            });
        });

        function confirmDelete(id) {
            var confirmDelete = confirm("Are you sure you want to delete this user?");
            if (confirmDelete == true) {
                window.location.replace("delete.php?id=" + id);
            } else {
                return false;
            }
        }


    </script>
</head>
<body class="show-admin">
<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="AdminDashboard.php">OnlineD Admin DASHBOARD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="AdminDashboard.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Admin Dashboard</span></span></a>
            <a href="find.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Hledat</span></span></a>
            <a href="logout.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Odhlásit se</span></span></a>

        </div>
    </nav>
</header>
<div class="hledat-nadpis">Zde hledej uživatele</div>
<div id="search-container">
    <input max="75" type="text" id="search" placeholder="Zadej klíčové slovo...">
    <div id="result"></div>
</div>
</body>
</html>
