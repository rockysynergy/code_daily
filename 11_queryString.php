<?php

// Implement an autocomplete system. That is, given a query string s and a set of all possible query strings, return all strings in the set that have s as a prefix.

// For example, given the query string de and the set of strings [dog, deer, deal], return [deer, deal].
class Query
{
    private $dict = [];

    public function __construct($dict) 
    {
        $t = [];
        foreach ($dict as $v) {
            $tl = strlen($v);
            for ($i=1;$i<$tl;$i++) {
                $t[substr($v, 0, $i)][] = $v;
            }
        }
        $this->dict = $t;
    }
    
    function query($k)
    {
        if (isset($this->dict[$k]) && count($this->dict[$k])>0) {
            return $this->dict[$k];
        } else {
            return [];
        }
    }
}

$a = new Query(['dog', 'deer', 'deal']);
var_dump($a->query('de'));