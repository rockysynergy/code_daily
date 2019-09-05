<?php

/**
 * Given k sorted singly linked lists, write a function to merge all the lists into one sorted singly linked list.
 */
function sortList($arr)
{
    $k = count($arr);

    $aList = $arr[0];
    $re = New ListNode();
    for ($i = 1; $i < $k; $i++) {
        $tcNode = $re;
        $bList = $arr[$i];
        while (!is_null($aList) && !is_null($bList)) {
            if ($aList->val <= $bList->val) {
                $tcNode->next = $aList;
                $aList = $aList->next;
            } else {
                $tcNode->next = $bList;
                $bList = $bList->next;
            }
            $tcNode = $tcNode->next;
        }

        while (!is_null($aList)) {
            $tcNode->next = $aList;
            $aList = $aList->next;
            $tcNode = $tcNode->next;
        }

        while (!is_null($bList)) {
            $tcNode->next = $bList;
            $bList = $bList->next;
            $tcNode = $tcNode->next;
        }
        $aList = $re->next;
    }
    echo 'ee';
    return $re;
}


class ListNode
{
    public $val;
    public $next = null;
}

function buildList(array $arr)
{
    $a = new ListNode();
    $a->val = $arr[0];
    $b = $a;

    for ($i=1; $i<count($arr); $i++) {
        $t = new ListNode();
        $t->val = $arr[$i];
        $a->next = $t;
        $a = $t;
    }

    return $b;
}

$a = buildList([1, 4, 15]);
$b = buildList([1, 5]);
$c = buildList([2, 6, 7]);
$z = sortList([$a, $b, $c]);
echo 'finished';