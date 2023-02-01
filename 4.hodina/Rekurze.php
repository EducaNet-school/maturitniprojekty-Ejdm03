<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fibonacci</title>
</head>
<body>
<form action="" method="post">
    <label for="n">Zadej do kterého čísla chceš Fibonnaciho posloupnost</label>
    <input type="text" name="n" id="n">
    <input type="submit" value="Calculate">
</form>
<?php
if (isset($_POST['n'])) {
    $n = intval($_POST['n']);
    function fibonacci($n) {
        if ($n == 1) {
            return 0;
        } else if ($n == 2) {
            return 1;
        } else {
            return fibonacci($n-1) + fibonacci($n-2);
        }
    }
    echo "Fibonacci do ".$n.". čísla:<br>";
    for ($i = 1; $i <= $n; $i++) {
        echo fibonacci($i)." ";
    }
}
?>
</body>
</html>
