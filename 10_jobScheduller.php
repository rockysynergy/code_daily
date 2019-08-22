<?php

// Implement a job scheduler which takes in a function fand an integer n, and calls fafter nmilliseconds.

function timeInterval($f, $t)
{
    $s = time();

    //$s = (int) $t/1000;
    while (true) {
        $n = time();
        $d = $n-$s;
        print $n .' >> '.$s.PHP_EOL;
        print $d. ' -- ' .$t.PHP_EOL;
        if ($d==$t) {
            print $f();
            $s = $n;
        }
        sleep(0.01);
    }
}

$f = function () {
    return 'I am called '.time().PHP_EOL;
};

timeInterval($f, 2);
