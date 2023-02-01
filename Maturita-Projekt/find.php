<?php
$servername = "localhost";
$db = "onlined";
$username = "root";
$password = "";


$conn = mysqli_connect($servername, $username, $password, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetchne data
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html lang="en">
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
    </script>
</head>
<body>
<nav>
    <a href="AdminDashboard.php">Users</a>
    <a href="find.php">Hledání</a>
    <a href="logout.php">Logout</a>
</nav>
<br>
<div id="search-container">
    <input type="text" id="search" placeholder="Search users...">
    <div id="result"></div>
</div>
</body>
</html>
