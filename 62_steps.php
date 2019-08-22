<?php

function num_steps($n) {
    $a = [];
    for ($i=0; $i<$n; $i++) {
        for ($j=0; $j<$n; $j++) {
            if ($i ==0 || $j == 0) {
                $a[$i][$j] = 1;
            } else {
                $a[$i][$j] = 0;
            }
        }
    }

    for ($i=1; $i<$n; $i++) {
        for ($j=1; $j<$n; $j++) {
            $a[$i][$j] = $a[$i-1][$j]+$a[$i][$j-1];
        }
    }
    return $a[$n-1][$n-1];
}

var_dump(num_steps(5));