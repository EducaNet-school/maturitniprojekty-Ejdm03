<?php

class Auto {
    private $typ;
    private $znacka;

    public function __construct($typ, $znacka) {
        $this->typ = $typ;
        $this->znacka = $znacka;
    }

    public function getInfo() {
        return "Typ: " . $this->typ . ", znacka: " . $this->znacka;
    }
}



class Nakladak extends Auto {
    private $nosnost;

    public function __construct($typ, $znacka, $nosnost) {
        parent::__construct($typ, $znacka);
        $this->nosnost = $nosnost;
    }

    public function getInfo() {
        return parent::getInfo() . ", nosnost: " . $this->nosnost;
    }
}


class Elektroauto extends Auto {
    private $vydrz_baterie;

    public function __construct($typ, $znacka, $vydrz_baterie) {
        parent::__construct($typ, $znacka);
        $this->vydrz_baterie = $vydrz_baterie;
    }

    public function getInfo() {
        return parent::getInfo() . ", vydrz baterie: " . $this->vydrz_baterie;
    }
}

$auto = new Auto("Sedan", "Toyota");

$nakladak = new Nakladak("Nakladak", "Volvo", "5t");

$elektroauto = new Elektroauto("Elektroauto", "Tesla", "300km");

$auta = array($auto, $nakladak, $elektroauto);


foreach ($auta as $currentAuto) {
    echo $currentAuto->getInfo() . "<br>";
}





?>