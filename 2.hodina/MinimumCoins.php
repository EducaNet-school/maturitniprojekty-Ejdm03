
<?php

// rozdělit penize na bankovyky , mít u sebe co nejméně.


function delenicko($poc)
{
    $hodnoty = array(1000, 500, 200, 100, 50, 20, 10, 5, 2, 1);
    $zbytek = $poc;
    $vysledek = array();

    for ($i = 0; $i < count($hodnoty); $i++) {
        $počet = floor($zbytek / $hodnoty[$i]);
        $zbytek = $zbytek % $hodnoty[$i];
        $vysledek[$hodnoty[$i]] = $počet;
    }
    return $vysledek;
}

$zaklad = 555;
$delenepenize = delenicko($zaklad);


print_r($delenepenize);



echo "<br>";
echo "<br>";

echo "Částka k dělení je"." ". $zaklad.".";

?>



<table border="5">
    <tr>
        <th>Hodnota</th>
        <th>Pocet</th>
    </tr>


    <?php
    foreach($delenepenize as $hodnoty=>$pocet){
        echo "<tr>";
        echo "<td>".$hodnoty."</td>";
        echo "<td>".$pocet."</td>";
        echo "</tr>";
    }
    ?>
</table>
