<?php

/**
 * Given a matrix of 1s and 0s, return the number of "islands" in the matrix. A 1 represents land and 0 represents water, so an island is a group of 1s that are neighboring whose perimeter is surrounded by water.

For example, this matrix has 4 islands.

1 0 0 0 0
0 0 1 1 0
0 1 1 0 0
0 0 0 0 0
1 1 0 0 1
1 1 0 0 1

 */

 class Iland 
 {
     public $rw = [];
     public $blw = [];
     public $bw = [];
     public $brw = [];
 }

 function findIland($arr) {
     $start = new Iland();
     $start->rw = ['0_0'];
     $ils = [$start];
     $n = count($arr);

     for ($i = 0; $i < $n; $i++) {
         for ($j = 0; $j < $n; $j++) {
             $k = $i.'_'.$j;
             addTo($ils, $k, $n);
         }
     }
 }

 function addTo(&$ils, $idx, $n) {
     $r = substr($idx, 0, 1);
     $c = substr($idx, -1, 1);
     $merged = FALSE;
    foreach ($ils as $aIland) {
        if (in_array($idx, $aIland->rw)) {
            $merged = TRUE;

            // Update next right and right below
            if ($c+1 < $n) {
                $aIland->rw = array_diff($aIland->rw, [$r.'_'.$c]);
                array_push($aIland->rw, $r.'_'.$c+1);
            }
            if ($c+1 < $n && $r+1 < $n) {
                $aIland->brw = array_diff($aIland->brw, [$r.'_'.$c]);
                array_push($aIland->brw, ($r+1).'_'.$c+1);
            }
        }

        if (in_array($idx, $aIland->brw)) {
            // update right

            //update blw

            //update bw
        }

        if (in_array($idx, $aIland->blw)) {
            $merged = TRUE;

            //update next below left and below
            if ($r+1 < $n) {
                if ($c-1 >= 0) {
                    $aIland->blw = array_diff($aIland->blw, [$r.'_'.$c]);
                    array_push($aIland->blw, ($r+1).'_'.$c-1);
                } 
                $aIland->bw = array_diff($aIland->bw, [$r.'_'.$c]);
                array_push($aIland->bw, ($r+1).'_'.$c);
            } 
        }

        if (in_array($idx, $aIland->bw)) {
            //update blw

            // update bw

            // update right

            // update brw
        }
    }
 }