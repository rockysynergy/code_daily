<?php

// Given a list of integers, write a function that returns the largest sum of non-adjacent numbers. Numbers can be 0or negative.

function getSum($list)
{
    $sum = 0;
    for ($i=2; $i<count($list); $i++) {
        for ($k=0; $k<$i; $k++) {
            $tSum = 0;
            for ($j=$k; $j<count($list); $j+=$i) {
                $tSum += $list[$j];
            }
            if ($tSum > $sum) $sum = $tSum;
        }
    }

    return $sum;
}

$a = [2, 4, 6, 2, 5];
$b = [5, 1, 1, 5];
$c = [2, 4, -6, 2, 5];
print getSum($a).PHP_EOL;
print getSum($b).PHP_EOL;
print getSum($c).PHP_EOL;