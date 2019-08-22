<?php

function generate()
{
    return [mt_rand(-1, 1), mt_rand(-1, 1)];
}

function isIn($co)
{
    return $co[0]*$co[0] + $co[1]*$co[1] < 1;
}

function estimate()
{
    $i = 1000000;
    $in_circle = 0;

    for ($j=0; $j<$i; $j++) {
        if (isIn(generate())) {
            $in_circle++;
        }
    }

    $piOverFour = $in_circle / $i;
    return $piOverFour*4;
}

print estimate().PHP_EOL;