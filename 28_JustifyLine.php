<?php

function justifyLing($wds, $k)
{
    outputLine($wds, $k, 0);
}

function outpuLine($wds, $k, $i)
{
    $t = count($wds);
    if ($i > $t) return;

    $s = $i;
    $len = 0;
    while($len <= $k+1) {
        $len = strlen($wds[$i++])+1;
    }

    $len -= strlen($wds[$i])+1;
    $extraSpaces = $k-$len;
    $wdCounts = ($i-1)-$s;
    $q = $extraSpaces / $wdCounts;
    $r = $extraSpaces % $wdCounts;

    $line = '';
    for ($j=0; $j<$wdCounts; $j++) {
        $line .= $wds[$s+$j];
        for ($m=0; $m<$q; $m++) {
            $line .= ' ';
        }
        if ($j<$r) {
            $line .=' ';
        }
    }
    print $line.PHPEOL;
    outpuLine($wds, $k, $i);
}


