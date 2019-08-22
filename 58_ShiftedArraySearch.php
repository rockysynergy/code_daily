<?php

function getRotationPoint($arr)
{
    $t = count($arr)-1;
    $i = floor($t/2);
    $dist = floor($i / 2);

    while (true) {
        if ($arr[0] > $arr[$i] && $arr[$i-1]>$arr[$i]) {
            break;
        } else if($dist == 0) {
            break;
        } else if($arr[0] <= $arr[$i]) {
            if ($arr[$i] < $arr[$t-1]) {
                $i = 0;
                break;
            }
            $i = $i + $dist;
        } else if($arr[$i-1] <= $arr[$i]) {
            $i = $i - $dist;
        } else {
            break;
        }

        $dist = floor($dist / 2);
    }
    return $i;
}

function bSearch($arr, $num):int
{
    $hi = count($arr)-1;
    $lo = 0;
    
    while ($lo <= $hi) {
        $mid = $lo + floor(($hi-$lo)/2);
        if ($num > $arr[$mid]) $lo = $mid+1;
        elseif ($num < $arr[$mid]) $hi = $mid-1;
        else return $mid;
    }
    return -1;
}

function dSearch($arr, $num):int
{
    $p = getRotationPoint($arr);
    if ($num == $arr[$p]) return $p;
    else if($num > $arr[0] && $num < $arr[$p-1]) return bSearch(array_slice($arr, 0, $p), $num); 
    else {
        $r = bSearch(array_slice($arr, $p), $num);
        if ($r > -1) {
            return $p + $r;
        } else {
            return $r;
        }
    }
}

$arr =  [29, 2, 8, 10, 11, 13, 18, 25, 28,];
// etRotationPoint($arr);
//var_dump(bSearch($arr, 12));
var_dump(dSearch($arr, 31));