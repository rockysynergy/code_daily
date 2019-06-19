<?php

class XorNode
{
    public $datum;
    public $addr;
    public $pnx; 

    public function __construct($addr, $datum, $npx=null)
    {
        $this->addr = $addr;
        $this->datum = $datum;
        if (!is_null($npx)) {
            $this->npx = $npx;
        } else {
            $this->npx = $addr;
        }
    }
}

class XorList
{
    public $head;
    public $tail;
    public $size = 0;

    public function __construct()
    {
       $node = new XorNode('0000', '0', '0000'); 
       $this->head = $node;
       $this->tail = $node;
    }

    public function add($el)
    {
        $addr = rand(10000, 9999);
        $node = new XorNode($addr, $el, $this->tail->addr);
        $this->tail->npx = $this->tail->npx ^ $addr;
        $this->tail = $node;
        $this->size++;
    }

    public function get($index)
    {
        if ($index < 1 || $index > $this->size) {
            throw new \Exception('index Outbound');
        }

        $node = $this->head;
        $pAddr = '0000';
        for ($i = 0; $i < $index; $i++) {
            $cAddr = $node->npx ^ $pAddr;
            $pAddr = $node->addr;
            $node = getByAddress($cAddr);
        }

        return $node;
    }
}