<?php

class tNode {
    public $left = null;
    public $right = null;
    public $val;

    public function __construct($v)
    {
        $this->val = $v;
    }
}


function deepest($node)
{
    if ($node && is_null($node->left) && is_null($node->right)) {
        return [$node, 1];
    }

    if (is_null($node->left)) {
        return increment_depth(deepest($node->right));
    }

    if (is_null($node->right)) {
        return increment_depth(deepest($node->left));
    }

    $lDe = deepest($node->left);
    $rDe = deepest($node->right);
    if ($lDe[1] >= $rDe[1]) {
        return increment_depth(deepest($node->left));
    } else {
        return increment_depth(deepest($node->right));
    }
}

function increment_depth(array $arr)
{
    list($node, $depth) = $arr;
    return [$node, $depth+1];
}


$b = new tNode('b');
$c = new tNode('c');
$d = new tNode('d');
$b->left = $d;

$a = new tNode('a');
$a->left = $b;
$a->right = $c;
print_r(deepest($a));