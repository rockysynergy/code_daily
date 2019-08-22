<?php

function getPair($str)
{
    if (strlen($str) == 0) return TRUE;

    $kv = ['}'=>'{', ']'=>'[', ')'=>'('];
    $q = [];
    for ($i=0; $i<strlen($str); $i++) {
        $ic = substr($str, $i, 1);
        if (in_array($ic, ['{', '[', '('])) {
            array_push($q, $ic);
        } 
    
        if (in_array($ic, ['}', ']', ')'])) {
            $pc = array_pop($q);
            if ($kv[$ic] != $pc) {
                return FALSE;
            }
        }
    }

    if (count($q)>0) {
        return FALSE;
    } else {
        return TRUE;
    }
}

var_dump(getPair("([])[]({})"));
var_dump(getPair("([)]"));