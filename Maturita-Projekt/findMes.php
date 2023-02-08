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
<nav>
    <a href="logout.php">Logout</a>
    <a href="profile.php?id=<?php echo $id; ?>">Edit</a>
    <a href="addMes.php">Add message</a>
    <a href="findMes.php">Hledat Zápisky</a>
</nav>
<br>
<div id="search-container">
    <input type="text" id="search" placeholder="Zadej klíčové slovo..">
    <div id="result"></div>
</div>
</body>
</html>
