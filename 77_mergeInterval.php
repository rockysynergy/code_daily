<?php

$arr = [[1, 3], [5, 8], [4, 10], [20, 25]];
$arr = [[1, 3], [4, 20]];
$arr = array_merge($arr, [[9, 16]]);
print_r(mergeInterval($arr));

function mergeInterval ($arr):array
{
    $len = count($arr);
    if ($len == 1) return $arr;
    
    $arr = Qsort::sort($arr);
    $a = [];
    $t = $arr[0];
    for ($i = 1; $i < $len; $i++) {
        $z = $arr[$i];
        if ($z[0] <= $t[1] && $t[1] < $z[1]) {
            $t[1] = $z[1];
        }

        if ($i == $len - 1 && $z[1] < $t[1]) {
            array_push($a, $t);
        }
        
        if ($z[0] > $t[1]) {
            array_push($a, $t);
            $t = $z;
            if ($i == $len - 1) {
                array_push($a, $z);
            }
        }
    }

    return $a;
}

class Qsort
{
    private static $arr = [];

    public static function sort(array $arr):array
    {
        self::$arr = $arr;
        self::doSort(self::$arr, 0, count($arr)-1);
        return self::$arr;
    }

    private static function doSort(&$arr, $lo, $hi):void
    {
        if ($hi <= $lo) return;
        $j = self::partition($arr, $lo, $hi);
        self::doSort($arr, $lo, $j-1);
        self::doSort($arr, $j+1, $hi);
    }

    private static function partition(&$arr, $lo, $hi):int
    {
        $v = $arr[$lo];
        $i = $lo;
        $j = $hi + 1;

        while (true) {
            while ($arr[++$i][0] < $v[0]) {
                if ($i == $hi) break;
            }

            while($arr[--$j][0] > $v[0]) {
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

// print_r(Qsort::sort([0, 8, 4, 12, 2, 10, 6, 14, 1, 9, 5, 13, 3, 11, 7, 15]));