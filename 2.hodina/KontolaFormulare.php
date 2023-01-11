<?php


function Kontrola()
{
    $jmeno = $_POST["jmeno"];
    $adresa = $_POST["adresa"];

    if (empty($jmeno) || empty($adresa)) {
        echo "Jméno a Adresa musí být zadány<br>";
    } else {
        if (str_word_count($jmeno) < 2) {
            echo "Slovo musí mít minimálne 2 slova<br>";
        } elseif (strlen($adresa) < 10) {
            echo "Adresa musí obsahovat minimalne 10 znaků<br>";
        } else {

            echo "Jméno: " . $jmeno . "<br>";
            echo "Adresa: " . $adresa . "<br>";

        }
    }
}


if (isset($_POST['ok'])){
    Kontrola();
}


?>
<h1>Formulář</h1>


<form action="KontolaFormulare.php" method="post">
    <label for="jmeno">Jmeno a Příjmení:</label>
    <input type="text" id="jmeno" name="jmeno"><br>
    <label for="adresa">Adresa:</label>
    <input type="text" id="adresa" name="adresa"><br>
    <input type="submit" value="ok" name="ok">
</form>

