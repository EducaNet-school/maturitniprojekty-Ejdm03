<?php

$id = $_COOKIE["id"];
$idd=$_COOKIE["id_d"];

include "connection.php";
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetchne data
$query = "SELECT * FROM messages";
$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Live Search Box</title>
    <link rel="stylesheet" href="styl.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $(document).ready(function(){
            $("#search").keyup(function(){
                var searchTerm = $(this).val();
                if (searchTerm != "") {
                    $.ajax({
                        type: 'post',
                        url: 'serchMes.php',
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
                window.location.replace("deleteD.php?id=" + id);
            } else {
                return false;
            }
        }


    </script>
</head>
<body>
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
<br>
<div class="hledat-nadpis">Zde hledej zápisky</div>
<div id="search-container">
    <input type="text" id="search" placeholder="Zadej klíčové slovo..">
    <div id="result"></div>
</div>
</body>
</html>
