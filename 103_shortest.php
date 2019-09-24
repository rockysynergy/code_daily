<?php

/**
 * Given a string and a set of characters, return the shortest substring containing all the characters in the set.

For example, given the string "figehaeci" and the set of characters {a, e, i}, you should return "aeci".

If there is no substring containing all the characters in the set, return null.
 */

function hasLetters($str, $letters)
{
    $col = [];
    $len = strlen($str);

    for ($i = 0; $i < $len; $i++) {
        //  已有子串的处理
        foreach ($col as $k => $v) {
            $v[2] += 1;
            if (in_array($str[$i], $v[0])) {
                $v[0] = array_diff($v[0], [$str[$i]]);
            }
            $col[$k] = $v;
        }

        // 新的子串
        if (in_array($str[$i], $letters)) {
            $item = [array_diff($letters, [$str[$i]]), $i, 1];
            $col[$i] = $item;
        }
    }

    if (count($col) < 1) {
        return null;
    }

    $min = INF;
    $mStr = null;
    foreach ($col as $item) {
        if (count($item[0]) < 1 && $item[2] < $min) {
            $min = $item[2];
            $mStr = substr($str, $item[1], $min);
        }
    }

    if ($min == INF) {
        return null;
    }
    return $mStr;
}


var_dump(hasLetters('figehaeci', ['a', 'e', 'i']));
var_dump(hasLetters('figehaeci', ['a', 'e', 'i']));
