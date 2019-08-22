<?php

class LfuCache
{
    private $minFreq = 0;
    private $capacity;
    private $valMap = [];
    private $freqMap = [];

    public function __construct(int $n)
    {
        $this->capacity = $n;
    }

    public function get($k)
    {
        if (!isset($this->valMap[$k])) {
            return null;
        }

        list($val, $freq) = $this->valMap[$k];
        // Delete freqMap entries
        unset($this->freqMap[$freq][$k]);
        if (count($this->freqMap[$freq]) < 1) {
            unset($this->freqMap[$freq]);
            if ($this->minFreq == $freq) {
                $this->minFreq += 1;
            }
        }

        // update the freqmap and valMap
        $this->valMap[$k] = [$val, $freq + 1];
        $nextFreq = isset($this->freqMap[$freq+1]) ? $this->freqMap[$freq+1] : [];
        $this->freqMap[$freq + 1] = array_merge($nextFreq, [$k => $k]);
        return $val;
    }

    public function set($k, $v)
    {
        if ($this->capacity == 0) {
            throw new Exception('The cache can not hold any element', 1566222576);
        }

        if (!in_array($k, $this->valMap)) {
            // Evict the least used cache item
            if (count($this->valMap) >= $this->capacity) {
                $eItem = array_shift($this->freqMap[$this->minFreq]);
                if (count($this->freqMap[$this->minFreq]) < 1) {
                    unset($this->freqMap[$this->minFreq]);
                }
                unset($this->valMap[$eItem]);
            }

            $this->valMap[$k] = [$v, 1];
            if (!isset($this->freqMap[1])) {
                $this->freqMap[1] = [];
            }
            $this->freqMap[1] = array_merge($this->freqMap[1], [$k => $k]);
            $this->minFreq = 1;
        } else {
            // update the entry and increase the frequency of the key
            list($_v, $f) = $this->valMap[$k];
            unset($this->freqMap[$f][$k]);
            if (count($this->freqMap[$f])<1) {
                if ($f == $this->minFreq) {
                    $this->minFreq +=1;
                }
                unset($this->freqMap[$f]);
            }

            $this->valMap[$k] = [$v, $f+1];
            if (!isset($this->freqMap[$f+1])) {
                $this->freqMap[$f+1] = [];
            }
            array_merge($this->freqMap[$f+1], [$k=>$k]);
        }
    }
}

// $a = ['a'=>'', 'b'=>''];
// $za = array_shift($a);
// var_dump($a);
// var_dump($za);

$a = new LfuCache(2);
$a->get('a');
$a->set('a', 'a_v');
var_dump($a->get('a'));
$a->set('a', 'a_v_a');
var_dump($a->get('a'));
$a->set('b', 'b_v');
var_dump($a->get('b').' -- '.$a->get('a'));
$a->set('c', 'c_v');
var_dump($a->get('b').' -- '.$a->get('a').' -- '.$a->get('c'));