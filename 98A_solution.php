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

 function isValid($board, $row, $col)
 {
     return $row >= 0 && $row < count($board) and $col >= 0 && $col < count($board[0]);
 }

 function search($board, $row, $col, $word, $index, $visited)
 {
     if (!isValid($board, $row, $col)) {
         return false;
     }

     if (in_array($row.'_'.$col, $visited)) {
         return false;
     }

     if ($board[$row][$col] != $word[$index]) {
         return false;
     }

     if ($index == strlen($word)-1) {
         return true;
     }

     array_push($visited, $row.'_'.$col);

     $ds = [[-1, 0], [1, 0], [0,-1], [0,1]];
     foreach ($ds as $n) {
         if (search($board, $row+$n[0], $col+$n[1], $word, $index+1, $visited)) {
             return true;
         }
     }

     // backtrace
     $k = array_search($row.'_'.$col, $visited);
     unset($visited[$k]);

     return false;
 }

 function findWord($board, $word)
 {
     $M = count($board);
     $N = count($board[0]);

     for ($r = 0; $r < $M; $r++) {
         for ($c = 0; $c < $N; $c++) {
             $visited = [];
             if (search($board, $r, $c, $word, 0, $visited)) {
                 return true;
             }
         }
     }
 }

 $board = [
    ['A','B','C','E'],
    ['S','F','C','S'],
    ['A','D','E','E']
 ];
 $board_a = [
    ['A','B','C','E'],
    ['S','C','C','D'],
    ['A','D','E','D']
 ];
 findWord($board_a, "BCED");