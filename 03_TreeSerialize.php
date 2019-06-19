<?php
/*
GGiven the root to a binary tree, implement serialize(root), which serializes the tree into a string, and deserialize(s), which deserializes the string back into the tree.
*/

class Node 
{
    public $left;
    public $right;
    public $val;

    public function __construct($val, $left=null, $right=null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}



function serializeTree(Node $tr)
{
    $str = '';
    $q = [];
    if (!is_null($tr)) array_push($q, $tr);

    while (count($q) > 0) {
        $a = array_shift($q);
        if ($a instanceof Node) {
            $str .= $a->val.',';
            
            $le = is_null($a->left) ? '-' : $a->left;
            array_push($q, $le);
            $r = is_null($a->right) ? '-' : $a->right;
            array_push($q, $r);
        } else {
            $str .= $a.',';
        }
    }

    return $str;
}

function deserializeTree($str)
{
    $arr = explode(',', $str);
    $tr = new Node($arr[0]);
    makeTree($tr, 0, $arr);

    return $tr;
}

function makeTree($root, $i, $data)
{
    if ($i > count($data)) return;

    if ($i*2+1 < count($data) && $data[$i*2+1] != '-') {
        $l = new Node($data[$i*2+1]);
        $root->left = $l;
    }
    if ($i*2+2 < count($data) && $data[$i*2+2] != '-') {
        $r = new Node($data[$i*2+2]);
        $root->right = $r;
    }
    if (isset($l)) makeTree($l, $i*2+1, $data);
    if (isset($r)) makeTree($r, $i*2+2, $data);
}

$tree = new Node('r', new Node('l'), new Node('r'));
$tree->left->left = new Node('l_l');
$tree->right->right = new Node('r_r');

// var_dump($tree->left->right);
$str = serializeTree($tree);
// var_dump($str);
$bTree = deserializeTree($str);
print $bTree->left->left->val.PHP_EOL;
print $bTree->right->right->val.PHP_EOL;