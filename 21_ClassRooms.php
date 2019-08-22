<?php

// Given an array of time intervals (start, end) for classroom lectures (possibly overlapping), find the minimum number of rooms required.

function getRoomNeeded($data) {
    usort($data, function ($a, $b) {
        if ($a[0] < $b[0]) return -1;
        if ($a[0] == $b[0]) return 0;
        if ($a[0] > $b[0]) return 1;
    });

    $aItem = $data[0];
    $n = 1;
    for ($i = 1; $i < count($data); $i++) {
        $bItem = $data[$i];
        if ($bItem[0] < $aItem[1]) {
            $n++;
        }
        if ($bItem[0] >= $aItem[1]) {
            $aItem = $bItem;
        }
    }

    return $n;
}

$d = [[30, 75], [0, 50], [60, 150]];
$r = getRoomNeeded($d);
var_dump($r);