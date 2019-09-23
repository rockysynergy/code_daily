<?php

/**
 * This problem was asked by Google.

Determine whether a doubly linked list is a palindrome. What if it’s singly linked?

For example, 1 -> 4 -> 3 -> 4 -> 1 returns True while 1 -> 4 returns False.
 */

class Node 
{
    public $next = null;
    public $data = null;
}

class Slist
{
    public $head = null;
    public $size = 0 ;
}

class Dlist
{
    public $head = null;
    public $size = 0 ;
    public $tail = null;
}

function sPolindrome($tList) {
    $els = [];
    for ($i = 0; $i < ceil($tList->size / 2); $i++) {
        array_push($els, $tList->data);
        $tList = $tList->next;
    }

    if (($tList->size % 2) == 1) {
        $tList = $tList->next;
    }
    while (!is_null($tList->next)) {
        $tp = array_pop($els);
        if ($tp != $tList->data) return false;
        $tList = $tList->next;
    }

    return true;
}

function dPolindrome($dList) {
    $mid = ceil($dList->size);
    $head = $dList->head;
    $tail = $dList->tail;

    for ($i = 0; $i < $mid; $i++) {
        if ($head->data != $tail->data) {
            return false;
        }
    }

    return true;
}
