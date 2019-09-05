<?php

/**
 * This is your coding interview problem for today.

This problem was asked by Google.

Invert a binary tree.

For example, given the following tree:

    a
   / \
  b   c
 / \  /
d   e f

should become:

  a
 / \
 c  b
 \  / \
  f e  d

 */

 class tNode 
 {
    public $left = null;
    public $right = null;
    public $val;

    public function __construct($val) 
    {
        $this->val = $val;
    }
 }

 function invertTree($tNode)
 {
     if (is_null($tNode) || (is_null($tNode->left) && is_null($tNode->right))) {
         return;
     }

     $aRight = $tNode->right;
     $tNode->right = $tNode->left;
     $tNode->left = $aRight;

     return invertTree($tNode->left);
     return invertTree($tNode->right);
 }

 function traverseTree($tNode)
 {
     $q = [$tNode];

     while(count($q) > 0) {
         $aNode = array_shift($q);
         if ($aNode == '-') {
             echo '- ';
         } else {
             echo $aNode->val . ' ';
    
             if (!is_null($aNode->left)) {
                 array_push($q, $aNode->left);
             } else {
                 array_push($q, '-');
             }
    
             if (!is_null($aNode->right)) {
                 array_push($q, $aNode->right);
             } else {
                 array_push($q, '-');
             }
         }
     }
 }

 $a = new tNode('a');
 $b = new tNode('b');
 $c = new tNode('c');
 $d = new tNode('d');
 $a->left = $b;
 $a->right = $c;
 $c->right = $d;
 traverseTree($a);
 echo PHP_EOL;
 invertTree($a);
 traverseTree($a);
 echo PHP_EOL;