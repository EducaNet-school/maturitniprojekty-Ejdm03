<html>
<head>
    <title>Geometrický kalkulátor</title>
    <script>
        function updateForm() {
            var shape = document.getElementById("shape").value;
            if (shape == "obdelnik") {
                document.getElementById("b").style.display = "block";
                document.getElementById("b_input").style.display = "block";
            } else {
                document.getElementById("b").style.display = "none";
                document.getElementById("b_input").style.display = "none";
            }
        }
    </script>
</head>
<body>
<form action="Kalkulator.php" method="post">
    <label>Vyberte útvar:</label><br>
    <select id="shape" name="shape" onchange="updateForm()">
        <option value="ctverec">Čtverec</option>
        <option value="obdelnik">Obdélník</option>
        <option value="triangle">Trojúhelník</option>
    </select><br><br>

    <label>Vyberte operaci:</label><br>
    <select name="operation">
        <option value="obvod">Obvod</option>
        <option value="area">Obsah</option>
    </select><br><br>

    <label>Zadejte stranu a:</label><br>
    <input type="text" name="a" value="<?php if (isset($a)) echo $a; ?>"><br><br>

    <label id="b" style="display: none;">Zadejte stranu b:</label><br>
    <input type="text" id="b_input" name="b" style="display: none;" value="<?php if (isset($b)) echo $b; ?>"><br><br>

    <input type="submit" value="Výpočet">

</form>

<?php
if (isset($_POST["shape"]) && isset($_POST["operation"]) && isset($_POST["a"])) {
    $shape = $_POST["shape"];
    $operation = $_POST["operation"];
    $a = $_POST["a"];
    $b = $_POST["b"];
    $result = "";
    if ($shape == "ctverec") {
        if ($operation == "obvod") {
            $result = $a * 4;
        } else {
            $result = $a * $a;
        }
    } elseif ($shape == "obdelnik") {
        if ($operation == "obvod") {
            $result = 2 * ($a + $b);
        } else {
            $result = $a * $b;
        }
    } elseif ($shape == "trojuhelnik") {
        if ($operation == "obvod") {
            $result = $a * 3;
        } else {
            $result = ($a * $a * sqrt(3)) / 4;
        }
    }
    echo "<br><br>Výsledek: $result";
}
?>
