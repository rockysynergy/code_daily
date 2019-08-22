<?php

// There exists a staircase with N steps, and you can climb up either 1 or 2 steps at a time. Given N, write a function that returns the number of unique ways you can climb the staircase. The order of the steps matters.

function stairCaseV1($n)
{
    $a = 1;
    $b = 2;

    for ($i=3; $i<=$n; $i++) {
        $c = $a+$b;
        $a = $b;
        $b = $c;
    }

    return $b;
}

// var_dump(stairCaseV1(4));
function stairCaseV2($n, $s)
{
    $cache = [];
    for ($i=0; $i<=$n; $i++) {
        $cache[$i] = 0;
    }
    $cache = 1;

    for ($i=1; $i<=$n; $i++) {
        foreach ($s as $j) {
            if ($i-$j >=0) {
                $cache[$i] += $cache[$i-$j];
            }
        }
    }

}