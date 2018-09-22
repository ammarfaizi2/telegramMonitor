<?php

require __DIR__."/../config/init.php";

if (!isset($_GET["session_name"])) {
	exit("You need to provide the session_name parameter!\n");
}
$pid = shell_exec("ps aux | grep telegramd | grep \"{$_GET['session_name']}\" | awk '{print $2}'");
print shell_exec("kill $pid");
print $pid;