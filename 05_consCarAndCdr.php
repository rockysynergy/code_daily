<?php
function cons($a, $b)
{
    return function ($f) use ($a, $b) {
        return $f([$a, $b]);
    };
}

function car($p) {
    $getK = function ($arr) {
        return $arr[0];
    };
    return $p($getK);
}

function cdr($p) {
    $getV = function ($arr) {
        return $arr[1];
    };
    return $p($getV);
}

$a = cons('a', 3);
print car($a).PHP_EOL;
print cdr($a).PHP_EOL;