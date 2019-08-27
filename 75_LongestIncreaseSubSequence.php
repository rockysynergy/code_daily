<?php

class LongestIncSequence
{
    private $arr = [];

    public function __construct(array $arr)
    {
        $l = count($arr);
        for ($i = 0; $i < $l; $i++){
            array_push($this->arr, [$i, $arr[$i]]);
        }
        // $this->arr = $arr;
        $this->sort($this->arr, 0, $l-1);
    }

    protected function sort(array &$arr, int $lo, int $hi)
    {
        if ($hi <= $lo) return;
        $j = $this->partition($arr, $lo, $hi);
        $this->sort($arr, $lo, $j - 1);
        $this->sort($arr, $j + 1, $hi);
    }

    protected function partition(array &$arr, int $lo, int $hi)
    {
        $i = $lo;
        $j = $hi + 1;
        $v = $arr[$lo];

        while (true) {
            while ($arr[++$i][1] < $v[1]) {
                if ($i == $hi) break;
            }

            while ($arr[--$j][1] > $v[1]) {
                if ($j == $lo) break;
            }

            if ($i >= $j) break;
            $this->exchange($arr, $i, $j);
        }
        $this->exchange($arr, $lo, $j);
        return $j;
    }

    private function exchange(&$arr, $i, $j) 
    {
        $t = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $t;
    }

    public function getSequence()
    {
        list($pos, $len) = $this->scanSeq();
        $a = array_splice($this->arr, $pos, $len);
        $re = [];
        foreach ($a as $v) {
            array_push($re, $v->val);
        }
        return $re;
    }

    protected function scanSeq()
    {
        $m = 0;
        $len = count($this->arr);

        $c = 0;
        $mc = 0;
        $ma = 0;
        for ($i = 0; $i < $len-1; $i++) {
            if ($this->arr[$i]->idx > $this->arr[$i+1]->idx) {
                if ($mc > $c) {
                    $c = $mc;
                    $m = $ma;
                }
                $ma = $i+1;
            }
            $mc++;
        }

        return [$m, $c];
    }
}

$arr = [0, 8, 4, 12, 2, 10, 6, 14, 1, 9, 5, 13, 3, 11, 7, 15];
$lis = new LongestIncSequence($arr);
// var_dump($lis->getSequence());

function liSubseq(array $arr)
{
    if (!is_array($arr)) {
        return 0;
    }

    $cache = [];
    for ($i = 0; $i < count($arr); $i++) {
        $cache[$i] = 1;
    }

    for ($i = 0; $i < count($arr); $i++) {
        for ($j = 0; $j < $i; $j++) {
            if ($arr[$i] > $arr[$j]) {
                $cache[$i] = max($cache[$i], $cache[$j] + 1);
            }
        }
    }

    return max($cache);
}
$arr = [0, 8, 4, 12, 2, 10, 6, 14, 1, 9, 5, 13, 3, 11, 7, 15];
var_dump(liSubseq($arr));