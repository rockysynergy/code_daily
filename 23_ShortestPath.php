<?php

class PathFinder
{
    private $matrix = [];
    private $marked = [];
    private $pathTo = [];
    private $start = [];
    private $end = [];

    public function __construct($matrix, $start, $end)
    {
        $c = count($matrix);
        for ($i=0; $i<$c; $i++) {
            for ($j=0; $j<$c; $j++) {
                $this->marked[$i][$j] = FALSE;
            }
        }
        $this->matrix = $matrix;
        $this->start = $start;
        $this->end = $end;

        $this->Bfs();
    }

    public function getSteps()
    {
        list($ex, $ey) = $this->end;
        if ($this->marked[$ex][$ey] === FALSE) {
            return -1;
        }

        $s = 0;
        for ($v = $this->end; $v[0].'_'.$v[1] != $this->start[0].'_'.$this->start[1]; $v = $this->pathTo[$v[0]][$v[1]]) {
            $s++;
        }
        return $s;
    }

    protected function Bfs()
    {
        $q = [];
        array_push($q, $this->start);
        list($sx, $sy) = $this->start;
        $this->marked[$sx][$sy] = TRUE;
        while (!empty($q)) {
            list($x, $y) = array_shift($q);
            foreach($this->getNeigbour($x, $y) as $n) {
                if (!$this->marked[$n[0]][$n[1]] && $this->matrix[$n[0]][$n[1]] == 'f') {
                    $this->pathTo[$n[0]][$n[1]] = [$x, $y];
                    $this->marked[$n[0]][$n[1]] = TRUE;
                    array_push($q, $n);
                }
            }
        }
    }

    protected function getNeigbour($x, $y)
    {
        $arr = [];
        if ($x>=1) array_push($arr, [$x-1, $y]);
        if ($x+1 < count($this->matrix)) array_push($arr, [$x+1, $y]);
        if ($y>=1) array_push($arr, [$x, $y-1]);
        if ($y+1 < count($this->matrix)) array_push($arr, [$x, $y+1]);

        return $arr;
    }

}

$matrix = [
    ['f', 'f', 'f', 'f'],
    ['t', 't', 'f', 't'],
    ['f', 'f', 'f', 'f'],
    ['f', 'f', 'f', 'f'],
];
/* $matrix = [
    ['f', 't'],
    ['f', 'f']
]; */
$p = new PathFinder($matrix, [3, 0], [0,0]);
echo $p->getSteps().PHP_EOL;