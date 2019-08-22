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
// print getSum($a).PHP_EOL;
// print getSum($b).PHP_EOL;
// print getSum($c).PHP_EOL;

function getSumV2($list)
{
    $cache = [];
    for ($i=0; $i<count($list); $i++) {
        array_push($cache, 0);
    }

    $cache[0] = max($cache[0], $list[0]);
    $cache[1] = max($cache[0], $list[1]);

    for ($i=2; $i<count($list); $i++) {
        $cache[$i] = max(($list[$i] + $cache[$i-2]), $cache[$i-1]);
    }
    return $cache[$i-1];
}

$a = [];
for ($i=0; $i<10000; $i++) {
    $a[$i] = rand(-1000, 1000000);
}
$s = time();
print getSum($a).PHP_EOL;
$diff = time()-$s;
print 'va timing: '.(string)$diff.PHP_EOL;

$s = time();
print getSumV2($a).PHP_EOL;
$diff = time()-$s;
print 'va timing: '.(string)$diff.PHP_EOL;