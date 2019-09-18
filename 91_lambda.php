<?php

/**
 * This problem was asked by Dropbox.

What does the below code snippet print out? How can we fix the anonymous functions to behave as we'd expect?

functions = []
for i in range(10):
    functions.append(lambda : i)

for f in functions:
    print(f())

 */

 $fs = [];

 for ($i = 0; $i < 10; $i++) {
     array_push($fs, function() use ($i) { echo $i; });
 }

 foreach ($fs as $f) {
     print $f();
 }
