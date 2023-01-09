<?php



function selection_sort($pole) {
    $pocet = count($pole);
    for ($i = 0; $i < $pocet - 1; $i++) {
        $min = $i;
        for ($j = $i + 1; $j < $pocet; $j++) {
            if ($pole[$j] < $pole[$min]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $temp = $pole[$i];
            $pole[$i] = $pole[$min];
            $pole[$min] = $temp;
        }
    }
    return $pole;
}


$policko = [10, 2,232, 55, 1];
$razenepolicko = selection_sort($policko);
print_r($razenepolicko);



?>