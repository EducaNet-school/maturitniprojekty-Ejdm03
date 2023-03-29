<?php
include "connection.php";

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Select data from the database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

$role = "";

// filter by role
if(isset($_POST["role"])) {
    $role = $_POST["role"];

    if ($role == "0" or $role == 1) {
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE adminRole = ?");
        mysqli_stmt_bind_param($stmt, "s", $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} elseif (isset($role) && $role == "") {
    $stmt = mysqli_prepare($conn, "SELECT * FROM users");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

// data pro statistics
$sql = "SELECT COUNT(*) / DATEDIFF(MAX(date), MIN(date)) as avg_messages_per_day FROM messages";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    $rowa = mysqli_fetch_assoc($res);
    $avg_messages_per_day = round($rowa["avg_messages_per_day"], 2);
} else {
    $avg_messages_per_day = 0;
}

$sql1 = "SELECT COUNT(*) AS total_messages FROM messages";
$res1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($res1) > 0) {
    $row1 = mysqli_fetch_assoc($res1);
    $total_messages = $row1["total_messages"];
} else {
    $total_messages = 0;
}

$sql2 = "SELECT COUNT(*) / DATEDIFF(NOW(), MIN(registrationd)) AS avg_reg FROM `users`";
$res2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($res2) > 0) {
    $row2 = mysqli_fetch_assoc($res2);
    $avg_registration = number_format($row2["avg_reg"], 2);
} else {
    $avg_registration = 0;
}

$sql3 = "SELECT COUNT(*) AS num_banned_users FROM `users` WHERE `Block` = 1";
$res3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($res3) > 0) {
    $row3 = mysqli_fetch_assoc($res3);
    $num_banned_users = $row3["num_banned_users"];
} else {
    $num_banned_users = 0;
}

$sql6 = "SELECT COUNT(*) / DATEDIFF(NOW(), MIN(date)) / 7 AS avg_messages_per_week FROM `messages`";
$res6 = mysqli_query($conn, $sql6);

if (mysqli_num_rows($res6) > 0) {
    $row6 = mysqli_fetch_assoc($res6);
    $avg_messages_per_week = number_format($row6["avg_messages_per_week"], 2);
} else {
    $avg_messages_per_week = 0;
}

$sql7 = "SELECT COUNT(*) / (DATEDIFF(NOW(), MIN(date)) / 30) AS avg_messages_per_month FROM `messages`";
$res7 = mysqli_query($conn, $sql7);

if (mysqli_num_rows($res7) > 0) {
    $row7 = mysqli_fetch_assoc($res7);
    $avg_messages_per_month = number_format($row7["avg_messages_per_month"], 2);
} else {
    $avg_messages_per_month = 0;
}
mysqli_close($conn);
?>
<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AdminDashboard</title>
    <link rel="stylesheet" href="styltest.css">
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
            <a href="AdminDashboard.php" class="nav-link active"><span class="nav-link-span"><span class="u-nav">Admin Dashboard</span></span></a>
            <a href="find.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Hledat</span></span></a>
            <a href="logout.php" class="nav-link"><span class="nav-link-span"><span class="u-nav">Odhlásit se</span></span></a>

        </div>
    </nav>
</header>

<div class="admin-nadpis">Admin Dashboard</div>
<div class="custom-select">
    <form action="AdminDashboard.php" method="POST">
        <select name="role" id="role">
            <option value="">--Select Role--</option>
            <option value="0" <?php if($role == "0") {echo "selected";} ?>>Uživatel</option>
            <option value="1" <?php if($role == "1") {echo "selected";} ?>>Admin</option>
            <option value="3" <?php echo "selected"; ?>>Všechny</option>
        </select>
        <div class="filtr">
            <input type="submit" value="Filtruj" class="filtr-button">
        </div>
    </form>
</div>


<div class="uzivatele">
<br>
<br>

<div class="table-users">
    <?php echo "<span class='admin-nadpis'>Celkem " . mysqli_num_rows($result) . " Uživatelé</span>";?>
<div class="inner-containertab">
    <table>
    <tr>
        <th>ID</th>
        <th>Jméno</th>
        <th>Příjmení</th>
        <th>Email</th>
        <th>Role</th>
        <th>Blokován</th>
        <th>Akce</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) {
        if ($row["adminRole"] == 0) {
            $adminRole = "Uživatel";
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



                <form method="post" action="edit.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="button-18">Upravit</button>
                </form>

                <form method="post" action="ban.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="button-delete">Blokovat</button>
                </form>

                <form id="deleteForm_<?php echo $row['id']; ?>" method="post" action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="button-delete" onclick="confirmDelete('<?php echo $row["id"]; ?>')">Smazat</button>
                </form>
            </td>
        </tr>
    <?php } ?>

</table>
</div>
</div>

<div  class="statistika-container">
    <div class="statistika-nadpis">Statistiky</div>
        <div class="inner-container">
            <div class='avg-messages-per-day'>Průměr zápisků za den: <?php echo $avg_messages_per_day; ?> </div>
            <div class='avg-messages-per-day'>Průměr zápisků za týden: <?php echo $avg_messages_per_week; ?> </div>
            <div class='avg-messages-per-day'>Průměr zápisků za měsíc: <?php echo $avg_messages_per_month; ?> </div>
            <div class='avg-messages-per-day'>Celkový počet zápisků: <?php echo $total_messages; ?> </div>
            <div class='avg-messages-per-day'>Průměr registrací za den: <?php echo $avg_registration; ?> </div>
            <div class='avg-messages-per-day'>Celkový počet blokací: <?php echo $num_banned_users; ?> </div>



        </div>
</div>
</div>



<script>
    function confirmDelete(id) {
        var confirmDelete = confirm("Opravdu cheš vymazat tohoto uživatele?" + id + "?");
        if (confirmDelete == true) {
            window.location.replace("delete.php?id=" + id);
        } else {
            event.preventDefault();
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