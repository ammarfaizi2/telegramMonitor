<?php

if (!isset($_GET["session_name"])) {
	?><!DOCTYPE html>
	<html>
	<head>
	<title>Telegram Monitoring</title>
	</head>
	<body>
	<h1>MadelineProto</h1>
	<form method="GET">
	<p>Enter a session name to save your session: </p>
	<input type="text" name="session_name">
	<button type="submit"/>Go</button>
	</form>
	</body>
	</html><?php exit;	
}

if (!is_string($_GET["session_name"])) {
	exit("Error, session name must be a string!\n");
}

chdir(__DIR__."/../storage/tmp");
set_include_path(__DIR__."/../storage/tmp");

if (!file_exists('madeline.php')) {
    copy("https://phar.madelineproto.xyz/madeline.php", "madeline.php");
}

include "madeline.php";

$MadelineProto = new \danog\MadelineProto\API(
	__DIR__."/../storage/telegram_sessions/".$_GET["session_name"]
);
$MadelineProto->start();
$me = $MadelineProto->get_self();
header("Content-type: text/plain");
echo "OK, done!".PHP_EOL;
