<?php

/**
 * This problem was asked by Google.

Given a word W and a string S, find all starting indices in S which are anagrams of W.

For example, given that W is "ab", and S is "abxaba", return 0, 3, and 4.
 */

function anagrams(string $w, string $s)
{
    $wLen = strlen($w);
    $sLen = strlen($s);
    $idxes = [];
    $re = [];

    for ($i=0; $i<$sLen; $i++) {
        if (strpos($w, $s[$i]) !== false) {
            array_push($idxes, $i);
        }
    }

    // var_dump($idxes);
    foreach ($idxes as $idx) {
        $substrs = [];
        $ls = $idx - $wLen + 1;
        if ($ls >= 0) {
            array_push($substrs, substr($s, $ls, $wLen));
        }
        $rs = $idx + $wLen - 1;
        if ($rs < $sLen) {
            array_push($substrs, substr($s, $idx, $wLen));
        }

        if (hasLetters($w, $substrs, $wLen)) {
            array_push($re, $idx);
        }
    }

    return $re;
}

function hasLetters(string $w, array $strs, $wLen):bool
{
    foreach ($strs as $str) {
        $flag = true;
        for ($j = 0; $j < $wLen; $j++) {
            if (strpos($w, $str[$j]) === false) {
                $flag = false;
                break;
            }
        }

        if ($flag) return true;
    }

    return false;
}


var_dump(anagrams("ab", 'abxaba'));
