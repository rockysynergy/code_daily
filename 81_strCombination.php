<?php

/**
 * Given a mapping of digits to letters (as in a phone number), and a digit string, return all possible letters the number could represent. You can assume each valid number in the mapping is a single digit.
 * For example if {“2”: [“a”, “b”, “c”], 3: [“d”, “e”, “f”], …} then “23” should return [“ad”, “ae”, “af”, “bd”, “be”, “bf”, “cd”, “ce”, “cf"].
 * 
 */
function get_permutations($digits, $map)
{
    $di = $digits[0];

    if (count($digits) == 1) {
        return $map[$di];
    }

    $re = [];
    foreach ($map[$di] as $char) {
        foreach (get_permutations(array_slice($digits, 1), $map) as $perm) {
            array_push($re, $char . $perm);
        }
    }

    return $re;
}

$m = [
    '1'=>['a', 'b', 'c'],
    '2'=>['d', 'e', 'f'],
    '3'=>['g', 'h', 'i'],
];

print_r(get_permutations(['1', '2', '3'], $m));