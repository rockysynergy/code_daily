<?php

/**
 * Implement division of two positive integers without using the division, multiplication, or modulus operators. Return the quotient as an integer, ignoring the remainder.
 */

function divid(int $n, int $d)
{
    $q = 0;
    while (true) {
        $n -= $d;
        if ($n >= 0) $q++;
        else break;
    }

    return $q;
}

echo divid(13, 5). PHP_EOL;
