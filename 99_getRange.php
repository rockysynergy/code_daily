<?php

/**
 * Given an unsorted array of integers, find the length of the longest consecutive elements sequence.

For example, given [100, 4, 200, 1, 3, 2], the longest consecutive element sequence is [1, 2, 3, 4]. Return its length: 4.

Your algorithm should run in O(n) complexity.
 */

 function getRange($arr)
 {
     $bounds = [];
     $max = 0;
     foreach ($arr as $i) {
         $left = $i;
         $right = $i;
         if (isset($bounds[$i-1])) {
             $left = $bounds[$i-1][0];
         }

         if (isset($bounds[$i+1])) {
             $right = $bounds[$i+1][1];
         }

         $bounds[$i] = [$left, $right];
         $bounds[$left] = [$left, $right];
         $bounds[$right] = [$left, $right];

         $max = max($right - $left + 1, $max);
     }

     return $max;
 }

 var_dump(getRange([100, 4, 200, 1, 3, 2]));
