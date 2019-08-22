<?php

function getAttacks(int $num, array $ps):int
{
    $c = count($ps);
    $re = 0;
    for($i = 0; $i < $c; $i++) {
        list($ax, $ay) = $ps[$i];
        if (($ax-$num)>-1 || ($ay-$num)>-1){
            throw Exception('Illegal argument');
        }
        
        for ($j=$i+1; $j < $c; $j++) {
            list($bx, $by) = $ps[$j];
            if (abs($bx-$ax) == abs($by-$ay)) {
                $re += 1;
            }
        }
    }

    return $re;
}

$arr = [
    [0, 0],
    [1, 2],
    [2, 2],
    [4, 0]
];
var_dump(getAttacks(5, $arr));