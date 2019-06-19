<?php
/* 
A unival tree (which stands for "universal value") is a tree where all nodes under it have the same value.
Given the root to a binary tree, count the number of unival subtrees.
 */

class Node
{
    public $data;
    public $left;
    public $right;

    public function __construct($data, $left = null, $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }
}

function countUnival(Node $node)
{
    $q = [];
    array_push($q, $node);
    $t = 0;

    while (count($q) > 0) {
        $aNode = array_shift($q);
        if (is_null($aNode->left) && is_null($aNode->right)) {
            $t++;
        } else if (!is_null($aNode->left) && is_null($aNode->right)) {
            array_push($q, $aNode->left);
        } else if (is_null($aNode->left) && !is_null($aNode->right)) {
            array_push($q, $aNode->right);
        } else {
            if ($aNode->left->data == $aNode->right->data) {
                $t++;
            }
            array_push($q, $aNode->left);
            array_push($q, $node->right);
        }
    }
    return $t;
}

$t = new Node(1, new Node(3), new Node(4));
print countUnival($t) . PHP_EOL;
