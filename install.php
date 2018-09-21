<?php

/**
 * @see https://secure.php.net/manual/en/function.proc-open.php
 */

$descriptorspec = array(
   0 => array("pipe", "r"),  
   1 => array("pipe", "w"),
   2 => array("file", "php://stdout", "w")
);

unset($_SERVER["argv"]);

$cwd = __DIR__;
$process = proc_open("composer install -vvv", $descriptorspec, $pipes, $cwd, $_SERVER);
if (is_resource($process)) {
    fclose($pipes[0]);
    print fread($pipes[1], 1024);
    fclose($pipes[1]);
    $return_value = proc_close($process);
}

$descriptorspec = array(
   0 => array("pipe", "r"),  
   1 => array("pipe", "w"),
   2 => array("file", "php://stdout", "w")
);

// unset($_SERVER["argv"]);

// $cwd = __DIR__."/mdpt";
// $process = proc_open("composer install -vvv", $descriptorspec, $pipes, $cwd, $_SERVER);
// if (is_resource($process)) {
//     fclose($pipes[0]);
//     print fread($pipes[1], 1024);
// 	fclose($pipes[1]);
//     $return_value = proc_close($process);
// }
