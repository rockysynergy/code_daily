<?php
/* 
Given a dictionary of words and a string made up of those words (no spaces), return the original sentence in a list. If there is more than one possible reconstruction, return any of them. If there is no possible reconstruction, then return null.

For example(A), given the set of words 'quick', 'brown', 'the', 'fox', and the string "thequickbrownfox", you should return ['the', 'quick', 'brown', 'fox'].

Given the set of words(B) 'bed', 'bath', 'bedbath', 'and', 'beyond', and the string "bedbathandbeyond", return either ['bed', 'bath', 'and', 'beyond] or ['bedbath', 'and', 'beyond'].
*/

// -- v1 only works for cases like the above examples which means the selected items cannot be shrinked
function findWords($dict, $str)
{
    $starts = [0=>''];
    for ($i=0; $i<strlen($str); $i++) {
        $newStarts = $starts;
        $j = 0;
        while ($j<=$i) {
            $wd = substr($str, $j, $i-$j+1);
            if (in_array($wd, $dict)) {
                $newStarts[$j] = $wd;
                $j += strlen($wd);
            }
            $j++;
        }
        $starts = $newStarts;
    }

    return $starts;
}

function assemble($starts, $str)
{
    $result = [];
    $cLength = strlen($str)-1;
    if (!isset($starts[$cLength])) {
        return 'none';
    }

    while ($cLength>=0) {
        $wd = $starts[$cLength];
        $cLength -= strlen($wd);
        array_push($result, $wd);
    }

    return array_reverse($result);
}

// var_dump(findWords(, ""));
$dictA = ['quick', 'brown', 'the', 'fox'];
$strA = 'thequickbrownfox';

// need to shrink
$dictB = ['ab', 'bca', 'a'];
$strB = 'abca';
/* $starts = findWords($dict, $str);
var_dump(assemble($starts, $str)); */


class Finder
{
    private $dict = [];
    private $str;
    private $adj = [];
    private $marked = [];
    private $edgeTo = [];

    public function __construct($dict, $str)
    {
        for ($i=0; $i<=strlen($str); $i++) {
            $this->adj[$i] = [];
            $this->marked[$i] = FALSE;
        }
        $this->dict = $dict;
        $this->str = $str;
    }

    public function find(): array
    {
        $this->buildGraph();
        $this->dfs(0);
        $end = strlen($this->str);

        $arr = [];
        if ($this->marked[$end] === FALSE) {
            return $arr;
        } else {
            for ($s=$end, $e=$this->edgeTo[$s]; ; $s=$e, $e=$this->edgeTo[$s]) {
                array_unshift($arr, substr($this->str, $e, $s-$e));
                if ($e===0) break;
            }
            return $arr;
        }
    }

    protected function dfs($v)
    {
        $this->marked[$v] = TRUE;
        foreach ($this->adj[$v] as $w) {
            if ($this->marked[$w] === FALSE) {
                $this->edgeTo[$w] = $v;
                $this->dfs($w);
            }
        }
    }

    protected function buildGraph()
    {
        for ($i=0; $i<=strlen($this->str); $i++) {
            $arr = [];
            for ($j = $i+1; $j<=strlen($this->str); $j++) {
                $wd = substr($this->str, $i, $j-$i);
                if (in_array($wd, $this->dict)) {
                    // array_push($this->adj[$j], $i);
                    array_unshift($arr, $j);
                }
            }
            $this->adj[$i] = $arr;
        }
    }
}

$f = new Finder($dictB, $strB);
print implode(',', $f->find()).PHP_EOL;

$f = new Finder(["a", "aa", "aaa", "aaaa", "aaaaa"], "aaaaab");
print implode(',', $f->find()).PHP_EOL;

