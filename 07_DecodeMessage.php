<?php

function countCombs($str)
{
    $str = (string) $str;
    $len = strlen($str);

    $c = 1;
    for ($i=0; $i<$len; $i +=3) {
        $j = 1;
        if (substr($str, $i, 2) < 27) $j++;
        if (substr($str, $i+1, 2) < 27) $j++;
        $c *= $j;
        if ($i > 0) {
            $k = $i - 3;
            if (substr($str, $k, 2) < 27 && substr($str, $k+2, 2) < 27 && substr($str, $K+4, 2) < 27) {
                $c += 1;
            }
        }
    }

    $r = $len % 3;
    if ($r == 1) {
        $count = true;
        for ($m=0; $m<$len; $m+=2) {
            if (substr($str, $m, 2) > 27) {
                $count = false;
                break;
            }
        }
        if ($count) $c++;
    }

    if ($r == 2) {
        if (substr($str, $len-2, 2) < 27) {
            $c *= 2;
        }

        $count = true;
        for ($m=0; $m<$len; $m+=2) {
            if (substr($str, $m, 2) > 27) {
                $count = false;
                break;
            }
        }
        if ($count) $c++;
    }

    return $c;
}

$a = 111;
print countCombs($a) . PHP_EOL;