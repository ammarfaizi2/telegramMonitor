<?php

require __DIR__."/../config/init.php";

if (!isset($_GET["session_name"])) {
	exit("You need to provide a session_name parameter\n");
}

if (!is_string($_GET["session_name"])) {
	exit("session_name parameter must be a string\n");
}

if (!file_exists(STORAGE_PATH."/telegram_sessions/{$_GET['session_name']}")) {
	exit("Session {$_GET['session_name']} does not exist!\n");
}

$a = shell_exec(
	"nohup /usr/bin/php7.2 ".BASEPATH."/bin/telegramd ".escapeshellarg($_GET["session_name"])." --daemonize telegram_daemon ".escapeshellarg("--user={$_GET['session_name']}")." 2>&1 >> ".escapeshellarg(STORAGE_PATH."/logs/{$_GET['session_name']}.log")." 2>&1 &"
);

print shell_exec("ps aux | grep ".escapeshellarg($_GET["session_name"])." | grep php | grep telegramd");
