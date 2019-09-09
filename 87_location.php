<?php

/**
 * A rule looks like this:

A NE B

This means this means point A is located northeast of point B.

A SW C

means that point A is southwest of C.

Given a list of rules, check if the sum of the rules validate. For example:

A N B
B NE C
C N A

does not validate, since A cannot be both north and south of C.

A NW B
A N B

is considered valid.
 */

/**
 * B['N'] = A
    A['S'] = B
    C['N'] = B, A -- since B['N'] = A
    C['E'] = B
    B['S'] = C
    B['W'] = C
    A['N'] = C, B, A
    C['S'] = A, B -- A in both C['S'] and C['N'] thus invalid
 */


function validate(array $items)
{
  $E = [];
  $V = TRUE;

  $ops = ['e' => 'w', 'w' => 'e', 's' => 'n', 'n' => 's'];
  foreach ($items as $item) {
    $parts = explode(' ', $item);
    $a = $parts[0];
    $b = $parts[2];
    $po = strtolower($parts[1]);
    $l = strlen($po);
    for ($i = 0; $i < $l; $i++) {
      $p = substr($po, $i, 1);
      $op = $ops[$p];
      $ap = isset($E[$a][$p]) ? $E[$a][$p] : [];
      $bp = isset($E[$b][$op]) ? $E[$b][$op] : [];
      $E[$b][$p] = array_merge($ap, [$a]);
      $E[$a][$op] = array_merge($bp, [$b]);

      if (((isset($E[$b][$p]) && isset($E[$b][$op])) && in_array($a, $E[$b][$p]) && in_array($b, $E[$b][$op])) || (isset($E[$a][$p]) && isset($E[$a][$op])) && (in_array($b, $E[$a][$p]) && in_array($b, $E[$a][$op]))) {
        $V = FALSE;
        break;
      }
    }
  }

  return $V;
}

$arr = [
  'A N B',
  'B NE C',
  'C N A',
];
var_dump(validate($arr));

$brr = [
  'A NW B',
  'A N B'
];
var_dump(validate($brr));
