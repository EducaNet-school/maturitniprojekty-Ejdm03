<?php
include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Fetch data from users table
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);


$role = "";


if(isset($_POST["role"])) {
    $role = $_POST["role"];

    if ($role == "0" or $role==1) {
        $query = "SELECT * FROM users WHERE adminRole = '$role'";
        $result = mysqli_query($conn, $query);
    }

    } elseif (!!$role == "1") {

        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
}

$sql = "SELECT COUNT(*) / DATEDIFF(MAX(date), MIN(date)) as avg_messages_per_day FROM messages";
$resulttt = mysqli_query($conn, $sql);

if (mysqli_num_rows($resulttt) > 0) {
    $rowa = mysqli_fetch_assoc($resulttt);
    $avg_messages_per_day = round($rowa["avg_messages_per_day"], 2);
} else {
    $avg_messages_per_day = 0;
}



$sql1 ="SELECT COUNT(*) AS total_messages FROM messages";
$result1 = mysqli_query($conn, $sql1);



if (mysqli_num_rows($result1) > 0) {
    $row1 = mysqli_fetch_assoc($result1);
    $total_messages = $row1["total_messages"];
} else {
    $total_messages = 0;
}






?>
<!doctype html>
<html lang="cz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminDashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header id="nav-wrapper">
    <nav id="nav">
        <div class="nav left">
        <span class="gradient skew">
          <h1 class="logo un-skew"><a href="AdminDashboard.php">OnlineD Admin DASHBOARD</a></h1>
        </span>
            <button id="menu" class="btn-nav"><span class="fas fa-bars"></span></button>
        </div>
        <div class="nav right">
            <a href="AdminDashboard.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Admin Dashboard</span></span></a>
            <a href="find.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Hledat</span></span></a>
            <a href="logout.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Odhlásit se</span></span></a>

        </div>
    </nav>
</header>
<br>
<br>
<br>
<br>
<br>
<br>

<h1>Admin Dashboard</h1>

<div class="custom-select">
    <form action="AdminDashboard.php" method="POST">
        <select name="role" id="role">
            <option value="">--Select Role--</option>
            <option value="0" <?php if($role == "0") {echo "selected";} ?>>Users</option>
            <option value="1" <?php if($role == "1") {echo "selected";} ?>>Admins</option>
            <option value="3" <?php echo "selected"; ?>>ALL</option>
        </select>
        <div class="filtr">
            <input type="submit" value="Filter">
        </div>
    </form>
</div>


<div class="uzivatele">
<br>
<br>

<div class="table-users">
<table>
    <tr>
        <th>ID</th>
        <th>Jméno</th>
        <th>Příjmení</th>
        <th>Email</th>
        <th>Admin Role</th>
        <th>Blokace</th>
        <th>Akce</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) {
        if ($row["adminRole"] == 0) {
            $adminRole = "User";
        } else if ($row["adminRole"] == 1) {
            $adminRole = "Admin";
        }

        if($row["Block"]== 0){
            $userBlock = "Ne";
        } elseif ($row["Block"]==1){
            $userBlock = "Blokován";
        }



        ?>

        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["firstname"]; ?></td>
            <td><?php echo $row["surname"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $adminRole; ?></td>
            <td><?php echo $userBlock; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                <a href="ban.php?id=<?php echo $row["id"]; ?>">Ban</a>
                <a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
</div>

<div  class="statistika-container">
    <div class="statistika-nadpis">Statistiky průměr</div>

    <div class='avg-messages-per-day'>Přidané zprávy za 1 den:<?php echo $avg_messages_per_day; ?> </div>
    <div class='avg-messages-per-day'>Celkový počet zpráv:<?php echo $total_messages; ?> </div>
</div>
</div>



<script>
    function confirmDelete(id) {
        var confirmDelete = confirm("Are you sure you want to delete the user with ID " + id + "?");
        if (confirmDelete == true) {
            window.location.replace("delete.php?id=" + id);
        } else {
            return false;
        }
    }
    var x, i, j, l, ll, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /* For each element, create a new DIV that will act as the selected item: */
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /* For each element, create a new DIV that will contain the option list: */
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {

            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {

                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {

            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {

        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    document.addEventListener("click", closeAllSelect);


</script>


</body>
</html>