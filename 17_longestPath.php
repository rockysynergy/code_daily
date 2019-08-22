<?php

$str = "dir\n\tsubdir1\n\tsubdir2\n\t\tfile.ext";

$b = preg_split('/\\n\\t/', $str);
var_dump($b);