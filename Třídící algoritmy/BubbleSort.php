<?php


function bubble_sort($pole) {
    $pocet = count($pole);
    for ($i = 0; $i < $pocet; $i++) {
        for ($j = 0; $j < $pocet - $i - 1; $j++) {
            if ($pole[$j] > $pole[$j + 1]) {
                // Swap elements at indices $j and $j + 1
                $temp = $pole[$j];
                $pole[$j] = $pole[$j + 1];
                $pole[$j + 1] = $temp;
            }
        }
    }
    return $pole;
}

$policko = [10, 2,232, 55, 1];
$razenepolicko = bubble_sort($policko);
print_r($razenepolicko);



?>

