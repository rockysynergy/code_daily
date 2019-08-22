<?php

function findWords($arr, $wd) {
    $m = 0;
    $n = 0;
    $z = 0;
    $wl = mb_strlen($wd);
    if ($z<$wl) $s = mb_substr($wd, $z++, 1);
    else return false;

    $ac = count($arr);
    for ($i=0; $i<$ac; $i++) {
        for ($j=0; $j<$ac; $j++) {
            if ($arr[$i][$j] == $s) {
                continue;
            } else {
                $m = $i;
                $n = $j;
                break 2;
            }
        }
    }

    $i = $m;
    $j = $n;
    while ($z < $wl) {
        if ($arr[++$i][$j] != mb_substr($wd, $z++, 1)) break;
    }
    if ($z == $wl) {
        return true;
    } else {
        $i = $m;
        $j = $n;
        while ($z < $wl) {
            if ($arr[$i][++$j] != mb_substr($wd, $z++, 1)) return false;
        }
        return true;
    }

}
