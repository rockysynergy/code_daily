<?php

/**
 * Write a map implementation with a get function that lets you retrieve the value of a key at a particular time.

It should contain the following methods:

    set(key, value, time): sets key to value for t = time.
    get(key, time): gets the key at t = time.

The map should work like this. If we set a key at a particular time, it will maintain that value forever or until it gets set at a later time. In other words, when we get a key at a time, it should return the value that was set for that key set at the most recent time.

Consider the following examples:

d.set(1, 1, 0) # set key 1 to value 1 at time 0
d.set(1, 2, 2) # set key 1 to value 2 at time 2
d.get(1, 1) # get key 1 at time 1 should be 1
d.get(1, 3) # get key 1 at time 3 should be 2

d.set(1, 1, 5) # set key 1 to value 1 at time 5
d.get(1, 0) # get key 1 at time 0 should be null
d.get(1, 10) # get key 1 at time 10 should be 1

d.set(1, 1, 0) # set key 1 to value 1 at time 0
d.set(1, 2, 0) # set key 1 to value 2 at time 0
d.get(1, 0) # get key 1 at time 0 should be 2

 */

 class Fetcher
 {
    private $V = [];

    public function set($key, $value, $time)
    {
        if (!isset($this->V[$key])) $this->V[$key] = [];
        $this->V[$key][$time] = $value;
    }

    public function get($key, $time)
    {
        if (!isset($this->V[$key])) {
            return null;
        }
        $v = $this->V[$key];
        for ($i=$time; $i>-1; $i--) {
            if (isset($v[$i])) return $v[$i];
        }

        return null;
    }
 }

 $f = new Fetcher();
 $f->set(1, 1, 0);
 $f->set(1, 2, 2);
 var_dump($f->get(1, 1));
 var_dump($f->get(1, 3));
 
 $f = new Fetcher();
 $f->set(1, 1, 5);
 var_dump($f->get(1, 0));
 var_dump($f->get(1, 10));
 
 $f = new Fetcher();
 $f->set(1, 1, 0);
 $f->set(1, 2, 0);
 var_dump($f->get(1, 0));