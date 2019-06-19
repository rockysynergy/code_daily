<?php
/* 
Given an array of integers, return a new array such that each element at index i of the new array is the product of all the numbers in the original array except the one at i.

For example, if our input was [1, 2, 3, 4, 5], the expected output would be [120, 60, 40, 30, 24]. If our input was [3, 2, 1], the expected output would be [2, 3, 6].

Follow-up: what if you can't use division? 
*/

$arr = [1, 3, 4, 9, 18];
$count = count($arr);

$aProd = [];
for ($i=0; $i<$count; $i++) {
    $pr = $i==0?1:$aProd[$i-1];
    array_push($aProd, $arr[$i]*$pr);
}

$bProd = [];
for ($j=$count-1; $j>=0; $j--) {
    $pr = $j==$count-1 ? 1 : $bProd[$j+1];
    $bProd[$j] = $arr[$j]*$pr;
}

$re = [];
for ($i=0; $i<$count; $i++) {
    if ($i==0) {
        $re[$i] = $bProd[$i+1];
    } else if($i == $count-1) {
        $re[$i] = $aProd[$i-1];
    } else {
        $re[$i] = $aProd[$i-1] * $bProd[$i+1];
    }
}

print_r($re);