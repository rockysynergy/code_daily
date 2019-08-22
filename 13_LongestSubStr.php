<?php

function getSubstrLen($s, $n)
{
    $tl = 0;
    for ($i=0; $i<strlen($s); $i++) {
        $l = 0;
        $t = [];
        for ($j=$i;$j<strlen($s);$j++) {
            $z = substr($s, $j, 1);
            if (in_array($z, $t)) {
                if (count($t)<$n) {
                    $l += 1;
                }
            } else {
                if (count($t) < $n) {
                    array_push($t, $z);
                    $l +=1;
                }
            }

            if (count($t) > $n) {
                if ($l > $tl) {
                    $tl = $l;
                }
                break;
            }
        }
    }
    
    return $tl;
}

var_dump(getSubstrLen('abcba', 2));