<?php

require __DIR__."/../config/init.php";

if (!isset($_GET["session_name"])) {
	exit("You need to provide the session_name parameter!\n");
}

if (!file_exists(STORAGE_PATH."/telegram_sessions/{$_GET['session_name']}")) {
	exit("Session {$_GET['session_name']} does not exist!");
}

shell_exec("nohup sh -c 'cd ".__DIR__."/..; php bin/tgbg \"{$_GET['session_name']}\" 2>&1 >> ".STORAGE_PATH."/logs/{$_GET['session_name']}.log 2>&1 &' >> /dev/null 2>&1 &");
#$pid = shell_exec("ps aux | grep telegramd | grep \"{$_GET['session_name']}\" | awk '{print $2}'");
#flush();
#exit($pid);
