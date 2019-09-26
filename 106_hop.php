<?php

/**
 * Given an integer list where each number represents the number of hops you can make, determine whether you can reach to the last index starting at index 0.

For example, [2, 0, 1, 0] returns True while [1, 1, 0, 1] returns False.

### hint We can see we can reach the Kth step if we can reach a step 0 <= j < K and j + hops[j] >= K.
 */

function canReach($hops)
{
    $left = 1;

    for ($i = 0 ; $i < count($hops)-1; $i++) {
        $left = max($left-1, $hops[$i]);
        if ($left === 0) {
            return false;
        }
    }

    return true;
}

canReach([2, 0, 1, 0]);
canReach([1, 1, 0, 1]);
