<?php

function countDel($arr)
{
    $rc = count($arr);
    $cc = count($arr[0]);

    $dc = 0;
    for ($c = 0; $c < $cc; $c++) {
        for ($r = 0; $r < $rc-1; $r++) {
            if ($arr[$r][$c] > $arr[$r+1][$c]) {
                $dc += 1;
                break;
            }
        }
    }

    return $dc;
}

$arr = [
    ['c', 'b', 'a'],
    ['d', 'a', 'f'],
    ['g', 'h', 'i']
];

$arr_1 = [
    ['c', 'a'],
    ['d', 'f'],
    ['g', 'i']
];

$arr_2 = [
    ['z', 'y', 'x'],
    ['w', 'v', 'u'],
    ['t', 's', 'r'],
];

echo countDel($arr_2) .PHP_EOL;