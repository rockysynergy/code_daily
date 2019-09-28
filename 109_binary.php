<?php

/**
 * Given an unsigned 8-bit integer, swap its even and odd bits. The 1st and 2nd bit should be swapped, the 3rd and 4th bit should be swapped, and so on.

For example, 10101010 should be 01010101. 11100010 should be 11010001.

Bonus: Can you do this in one line?
 */

 $b = 1010;

 function swap($a) {
     $b = '';
     for ($i = 0; $i < 8; $i+=2) 
     {
        $b .= $a[$i+1].$a[$i];
     }

     return $b;
 }
//  var_dump(base_convert($b, 2, 2));
var_dump(swap('10101010'));
var_dump(swap('11100010'));
