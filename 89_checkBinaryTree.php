<?php

/**
 * Determine whether a tree is a valid binary search tree.

A binary search tree is a tree with two children, left and right, and satisfies the constraint that the key in the left child must be less than or equal to the root and the key in the right child must be greater than or equal to the root.
 */

 function check($t)
 {
     $q = [];
     if (is_null($t)) return TRUE;
     if ( (!is_null($t->left) && $t->left->val > $t->val) || (!is_null($t->right) && $t->right->val < $t->val)) {
         return FALSE;
     }
     if (!is_null($t->left)) array_push($q, $t->left);
     if (!is_null($t->right)) array_push($q, $t->right);

     while (count($q) > 0) {
         $m = array_shift($q);

         if ($m->left->val > $m->val || $m->right->val < $m->val) {
             return FALSE;
         }
         if (!is_null($m->left)) array_push($q, $m->left);
         if (!is_null($m->right)) array_push($q, $m->right);
     }

     return TRUE;
 }