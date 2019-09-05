<?php

/**
 * Given an array of integers, write a function to determine whether the array could become non-decreasing by modifying at most 1 element.
 *
 * For example, given the array [10, 5, 7], you should return true, since we can modify the 10 into a 1 to make the array non-decreasing.
 *
 * Given the array [10, 5, 1], you should return false, since we can't modify any one element to get a non-decreasing array.
 */

var_dump(canBeNonDecreasing([10, 5, 7]));
var_dump(canBeNonDecreasing([10, 5, 1]));

function canBeNonDecreasing(array $arr):bool
{
    $a = [];
    foreach ($arr as $k=>$v) {
        array_push($a, [$k, $v]);
    }
    $a = Qsort::sort($a);

    $ic = 0;
    for ($i = 0; $i < count($a)-1; $i++) {
        if ($a[$i][0] > $a[$i+1][0]) {
            $ic++;
        }
    }
    if ($ic > 1) return false;
    else return true;
}

class Qsort
{
    public static function sort(array $arr):array 
    {
        self::doSort($arr, 0, count($arr)-1);
        return $arr;
    }

    private static function doSort(&$arr, $lo, $hi):void 
    {
        if ($lo >= $hi) return;
        $j = self::partition($arr, $lo, $hi);
        self::doSort($arr, $lo, $j-1);
        self::doSort($arr, $j+1, $hi);
    }

    private static function partition(&$arr, $lo, $hi):int
    {
        $i = $lo;
        $j = $hi+1;
        $v = $arr[$i];

        while (true) {
            while ($arr[++$i][1] < $v[1]) {
                if ($i == $hi) break;
            }

            while ($arr[--$j][1] > $v[1]) {
                if ($j == $lo) break;
            }

            if ($i >= $j) break;
            self::exchange($arr, $i, $j);
        }
        self::exchange($arr, $lo, $j);
        return $j;
    }

    private static function exchange(&$arr, $i, $j):void 
    {
        $t = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $t;
    }
}