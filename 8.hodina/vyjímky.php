<?php
class Film {
    private $nazev;
    private $vstupne;
    private $vekovaHranice;

    public function __construct($nazev, $vstupne, $vekovaHranice) {
        $this->nazev = $nazev;
        $this->vstupne = $vstupne;
        $this->vekovaHranice = $vekovaHranice;
    }

    public function getNazev() {
        return $this->nazev;
    }

    public function getVstupne() {
        return $this->vstupne;
    }

    public function getVekovaHranice() {
        return $this->vekovaHranice;
    }
}

class Divak {
    private $jmeno;
    private $vek;
    private $penize;

    public function __construct($jmeno, $vek, $penize) {
        $this->jmeno = $jmeno;
        $this->vek = $vek;
        $this->penize = $penize;
    }

    public function getJmeno() {
        return $this->jmeno;
    }

    public function getVek() {
        return $this->vek;
    }

    public function getPenize() {
        return $this->penize;
    }
}

class Kino {
    public function ProdejLístku($film, $divak) {
        if ($divak->getVek() < $film->getVekovaHranice()) {
            throw new CustomerTooYoungException("Divák " . $divak->getJmeno() . " je příliš mladý na film " . $film->getNazev());
        }
        if ($divak->getPenize() < $film->getVstupne()) {
            throw new MissingMoneyException("Divák " . $divak->getJmeno() . " nemá dostatek peněz na zakoupení lístku pro film " . $film->getNazev());
        }
        echo "Prodáno lístek na film " . $film->getNazev() . " pro diváka " . $divak->getJmeno() . "<br>";
    }
}

class CustomerTooYoungException extends Exception {}
class MissingMoneyException extends Exception {}

$kino = new Kino();
$film1 = new Film("Hellboy", 250, 18);
$film2 = new Film("Medvídek Pů", 150, 6);
$divak = new Divak("Franta Vopršálek", 19, 260);

try {
    $kino->ProdejLístku($film1, $divak);

} catch (Exception $e) {
    echo 'Chyba: ' . $e->getMessage() . "<br>";
}

try {
    $kino->ProdejLístku($film2, $divak);

} catch (Exception $e) {
    echo 'Chyba: ' . $e->getMessage() . "<br>";
}
?>
