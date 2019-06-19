<?php

function getLoInterger(array $arr) 
{
    sort($arr,SORT_NUMERIC);
    $total = count($arr);
    $missing = 1;
    for ($i=0; $i<$total; $i++) {
        if ($arr[$i]==$missing) $missing++;
        if ($arr[$i] > 0 && $missing < $arr[$i]) break;
    }
    return $missing;
}

$arr = [3, 4, -1, 1];
print getLoInterger($arr).PHP_EOL;
print getLoInterger([1, 2, 0]).PHP_EOL;