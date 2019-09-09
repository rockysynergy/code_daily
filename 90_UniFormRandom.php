<?php
/**
 * Given an integer n and a list of integers l, write a function that randomly generates a number from 0 to n-1 that isn't in l (uniform).
 */

 $A = [];
function random($n, $l)
{
    global $A;
    $t = rand(0, $n-1);
    while (in_array($t, $l) && in_array($t, $A)) {
        $t = rand(0, $n-1);
    }
    array_push($A, $t);
    return $t;
}
