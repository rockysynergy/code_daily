<?php

class Sudoku
{
    private $board;

    public function __construct(array $board) 
    {
        $this->sudo($board);
    }

    protected function sudo(array $board) 
    {
        if ($this->isCompleted($board)) return $board;

        list($r, $c) = $this->findFirstEmpty($board);

        for ($i=0; $i<10; $i++) {
            $board[$r][$c] = $i;
            if ($this->validSoFar($board)) {
                $result = $this->sudo($board);
                if ($this->isCompleted($board)) {
                    return $result;
                }
            }
            $board[$r][$c] = null;
        }
        return $board;
    }

    public function isCompleted(array $board):bool
    {
        $l = count($board);
        for ($i = 0; $i < $l; $i++) {
            for ($j = 0; $j < $l; $j++) {
                if (is_null($board[$i][$j])) {
                    return false;
                }
            }
        }

        return true;
    }

    public function findFirstEmpty(array $board):array
    {
        $l = count($board);
        for ($i = 0; $i < $l; $i++) {
            for ($j = 0; $j < $l; $j++) {
                if (is_null($board[$i][$j])) {
                    return [$i, $j];
                }
            }
        }
        return [];
    }

    protected function validSoFar(array $board):bool
    {
        if (!$this->rowValid($board)) return false;
        if (!$this->colValid($board)) return false;
        if (!$this->blockValid($board)) return false;

        return true;
    }

    protected function rowValid(array $board):bool
    {
        $l = count($board);
        for ($i = 0; $i < $l; $i++) {
            $a = [];
            for ($j = 0; $j < $l; $j++) {
                array_push($a, $board[$i][$j]);
            }
            if ($this->duplicate($a)) {
                return false;
            }
        }
        return true;
    }

    protected function colValid(array $board):bool
    {
        $l = count($board);
        for ($i = 0; $i < $l; $i++) {
            $a = [];
            for ($j = 0; $j < $l; $j++) {
                array_push($a, $board[$j][$i]);
            }
            if ($this->duplicate($a)) {
                return false;
            }
        }
        return true;
    }

    protected function blockValid(array $board):bool
    {
        for ($i = 0; $i < 9; $i += 3) {
            for ($j = 0; $j < 9; $j += 3) {
                $bs = [];
                for ($m = 0; $m < 3; $m++) {
                    for ($n = 0; $n < 3; $n++) {
                        array_push($bs, $board[$i+$m][$j+$n]);
                    }
                }
                if ($this->duplicate($bs)) {
                    return false;
                }
            }
        }

        return true;
    }

    protected function duplicate(array $a):bool
    {
        $l = count($a);
        $b = [];
        for ($j = 0; $j < $l; $j++) {
            if (in_array($a[$j], $b) && !is_null($a[$j])) {
                return true;
            }
        }
        return false;
    }
}