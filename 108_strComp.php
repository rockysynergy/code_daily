<?php

/**
 * Given two strings A and B, return whether or not A can be shifted some number of times to get B.

For example, if A is abcde and B is cdeab, return true. If A is abc and B is acb, return false.
 */

 function comp($str1, $str2)
 {
     $l1 = strlen($str1);
     $l2 = strlen($str2);
     
     if ($l1 !== $l2) return false;
     for ($i = 0, $j = strpos($str2, $str1[0]); $i < $l1 && $j < $l2; $i++, $j = (($j+1)%$l2)) {
         if ($str1[$i] !== $str2[$j]) return false;
     }

     return true;
 }

 var_dump(comp('abcde', 'cdeab'));
 var_dump(comp('abc', 'cba'));
