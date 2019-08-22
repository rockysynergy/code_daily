<?php

class LeastRecentlyUsedCache
{
    private $capacity = 0;
    private $items = [];
    private $useRec = [];

    public function __construct(int $num)
    {
        if ($num<1) throw new Exception('Capacity should be greather than 0');
        $this->capacity = $num;
    }

    public function set($k, $v)
    {
        if (count($this->items) == $this->capacity) {
            $ok = array_shift($this->useRec);
            unset($this->items[$ok]);
        }
        $p = array_push($this->useRec, $k);
        count($this->useRec)-1;
        $this->items[$k] = [$v, $p-1];
    }

    public function get($k)
    {
        if (isset($this->items[$k])) {
            $v = $this->items[$k][0];
            $p = $this->items[$k][1];
            array_splice($this->useRec, $p, 1);
            $p = array_push($this->useRec, $k);
            $this->items[$k] = [$v, $p-1];
            return $v;
        } else {
            return null;
        }
    }
}

$c = new LeastRecentlyUsedCache(2);
$c->set('a', 'a_v');
if ($c->get('a') !== 'a_v') echo 'Line 42 failed!!'.PHP_EOL;
$c->set('b', 'b_v');
$c->set('c', 'c_v');
if (!is_null($c->get('a'))) echo 'Line 45 failed!!'.PHP_EOL;