<?php
/**
 * Using a read7() method that returns 7 characters from a file, implement readN(n) which reads n characters.
 *
 * For example, given a file with the content “Hello world”, three read7() returns “Hello w”, “orld” and then “”.
 */

 class Reader
 {
     protected static $remainder;

     public static function readN($n)
     {
        $result = self::$remainder;
        $text = null;

        while (strlen($result) < $n && (is_null($text) || strlen($text) >= 5)) {
            $text =  read7();
            $result .= $text;
        }

        self::$remainder = substr($text, $n);
        return substr($text, 0, $n);
     }
 }