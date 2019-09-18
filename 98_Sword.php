<?php

/**
 * Given a 2D board of characters and a word, find if the word exists in the grid.

The word can be constructed from letters of sequentially adjacent cell, where "adjacent" cells are those horizontally or vertically neighboring. The same letter cell may not be used more than once.

For example, given the following board:

[
  ['A','B','C','E'],
  ['S','F','C','S'],
  ['A','D','E','E']
]

exists(board, "ABCCED") returns true, exists(board, "SEE") returns true, exists(board, "ABCB") returns false.
 */

 class Sword
 {
     private $B = [];
     private $hasWord = false;
     private $r = 0;
     private $c = 0;

     public function __construct(array $B)
     {
         $this->B = $B;
         $this->c = count($this->B[0]);
         $this->r = count($this->B);
     }

     public function hasWord(string $str) 
     {
         $fs = substr($str, 0, 1);
         $ns = substr($str, 1, 1);
         
         $q = [];
         for ($i=0; $i<$this->r; $i++) {
             for ($j=0; $j<$this->c; $j++) {
                $nn = $this->findNext($i, $j, $ns);
                if ($this->B[$i][$j] == $fs && count($nn) > 0) {
                    list($r, $c, $s) = $nn;
                    array_push($q, [$r, $c, $s]);
                }
             }
         }

         if (count($q) < 1) {
            return false;
         } else {
             $first = array_pop($q);
             $this->find(substr($str, 2), $first[0], $first[1], [$ns], $q);
             return $this->hasWord;
         }
     }

     private function find(string $str, int $r, int $c, array $ps, array $q)
     {
        if (strlen($str) < 1) $this->hasWord = true;

        $n = substr($str, 0, 1);
        $nn = $this->findNext($r, $c, $n);
        if (count($nn) < 1) {
            if (count($q) < 1)  {
                return;
            } else {
                $v = array_pop($q);
                while (count($ps) > 0) {
                    $t = array_shift($ps);
                    $str = $t.$str;
                    if ($v[3] == $t) {
                        $this->find($str, $v[0], $v[1], $ps, $q);
                        break;
                    }
                }
            }
        } else {
            if (count($nn) > 1) {
                for ($i = 1; $i < count($nn); $i++) {
                    $z = $nn[$i];
                    array_push($q, [$z[0], $z[1], $z[2]]);
                }
            } 
            array_push($ps, $n);
            $this->find(substr($str, 1), $nn[0][0], $nn[0][1], $ps, $q);
        }
     }

     private function findNext(int $r, int $c, string $n)
     {
         $arr = [];

     }
 }

 class SwordB
 {
     private $B = [];
     private $fork = [];
     private $marked = [];
     private $rc = 0;
     private $cc = 0;
     private $found = false;

     public function __construct(array $B) 
     {
         $this->B = $B;
         $this->rc = count($this->B);
         $this->cc = count($this->B[0]);
     }

     public function hasWord(string $wd)
     {
         $s = substr($wd, 0, 1);
         $wd = substr($wd, 1);
         $sPos = [];
         for ($i = 0; $i < $this->rc; $i++) {
             for ($j = 0; $j < $this->cc; $j++) {
                if ($s == $this->B[$i][$j]) {
                    $sPos = [$i, $j];
                    $this->marked[$i][$j] = true;
                }
             }
         }
         if (count($sPos) < 1) {
             return false;
         }
         $trace = $sPos;
         array_push($trace, substr($wd, 1, 1));
         $this->find($wd, $sPos, $trace);
     }

     public function find(string $wd, array $pos, array $trace)
     {
        if (strlen($wd) < 1) {
            $this->found = true;
            return;
        }
        $s = substr($wd, 0, 1);
        list($r, $c) = $pos;
        $wd = substr($wd, 1);
        $n = substr($wd, 0, 1);

        if ($r < $this->rc-1 && $s == $this->B[$r+1][$c]) {
            $this->marked[$r][$c] = true;
            return $this->find($wd, [$r+1, $c], [$r+1, $c, $n]);
        } else if ($r > 1 && $s == $this->B[$r-1][$c]) {
            $this->marked[$r][$c] = true;
            return $this->find($wd, [$r-1, $c], [$r-1, $c, $n]);
        } else if ($c < $this->cc-1 && $s == $this->B[$r][$c+1]) {
            $this->marked[$r][$c] = true;
            return $this->find($wd, [$r, $c+1], [$r, $c+1, $n]);
        } else if ($c > 1 && $s == $this->B[$r][$c-1]) {
            $this->marked[$r][$c] = true;
            return $this->find($wd, [$r, $c-1], [$r, $c-1]);
        } else {
            
        }
     }
 }