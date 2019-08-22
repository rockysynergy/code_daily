<?php

function matches($str, $pat)
{
    if (strlen($str) == 0 && strlen($pat) == 0) {
        return TRUE;
    }
    if (substr($pat, 0, 1) !== '.' && substr($str, 0, 1) !== substr($pat, 0, 1)) {
        return false;
    }

    if (substr($pat, 1, 1) == '*') {
        if (substr($pat, 0, 1) === '.') {
            if (substr($str, 0, 1) === substr($pat, 2, 1)) {
                return matches(substr($str, 1), substr($pat, 3));
            } else {
                return matches(substr($str, 1), substr($pat, 0));
            }
        }
        if (substr($str, 0, 1) !== substr($pat, 0, 1)) {
            if (substr($str, 0, 1) === substr($pat, 2, 1)) {
                return matches(substr($str, 1), substr($pat, 3));
            } else {
                return FALSE;
            }
        } else {
            return matches(substr($str, 1), $pat);
        }
    } else {
        if (substr($str, 0, 1) === substr($pat, 0, 1)) {
            return matches(substr($str, 1), substr($pat, 1));
        }
        if (substr($pat, 0, 1) == '.') {
            return matches(substr($str, 1), substr($pat, 1));
        }
    }
}

var_dump(matches('ray', 'ra.'));
var_dump(matches('raymond', 'ra.'));
var_dump(matches('chat', '.*at'));