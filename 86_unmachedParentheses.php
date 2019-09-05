<?php

/**
 * Given a string of parentheses, write a function to compute the minimum number of parentheses to be removed to make the string valid (i.e. each open parenthesis is eventually closed).

For example, given the string "()())()", you should return 1. Given the string ")(", you should return 2, since we must remove all of them.
 */

 function mismatchParens(string $str)
 {
     $stack = [];
     $l = strlen($str);
     $ms = 0;

     for ($i = 0; $i < $l; $i++) {
         $s = substr($str, $i, 1);
         if ($s == '(') {
             array_push($stack, '(');
         }

         if ($s == ')') {
            if (count($stack) < 1) {
                $ms++;
            } else {
                array_pop($stack);
            }
         }
     }

     $ms += count($stack);

     return $ms;
 }

 echo mismatchParens('()())()').PHP_EOL;
 echo mismatchParens(')(').PHP_EOL;
 echo mismatchParens('()').PHP_EOL;