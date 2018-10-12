<?php

use TelegramDaemon\Database;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 */
class TelegramMonitoringAPI
{	
	/**
	 * @var string
	 */
	private $apiMethod = "";

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		if (!isset($_GET["method"])) {
			$this->error("You need to provide the \"method\" parameter");
		}

		if (!is_string($_GET["method"])) {
			$this->error("\"method\" parameter must be a string");
		}

		$this->apiMethod = trim(strtolower($_GET["method"]));
		
		if (isset($_GET["session_name"])) {
			$pidFile = STORAGE_PATH."/pid/{$_GET['session_name']}.pid";
			if (file_exists($pidFile)) {
				$pidData = json_decode(file_get_contents($pidFile), true);
				if (is_array($pidData) && $pidData!==[]) {
					$sh = trim(shell_exec("ps aux | grep {$pidData[0]}"));
					if (count(explode("\n", $sh)) < 3) {
						unlink($pidFile);
					}
				}
			}
		}
	}

	/**
	 * @return void
	 */
	public function run(): void
	{
		switch ($this->apiMethod) {
			case "get_status":
				$this->getStatus();
				break;
			case "run_daemon":
				$this->runDaemon();
				break;
			case "kill_daemon":
				$this->killDaemon();
				break;
			case "channel_topic_count":
				$this->channelTopicCount();
				break;
			case "private_topic_count":
				$this->privateTopicCount();
				break;
			default:
				$this->error("Method \"{$this->apiMethod}\" does not exist");
				break;
		}
	}

	/**
	 * @return void
	 */
	private function channelTopicCount(): void
	{
		$db = new Database;
		$a = $db->channelTopicCount($start = time() - (3600 * 3), time());
		$this->success([
			"count" => $a,
			"start_date" => date("d F Y", $start),
			"end_date" => date("d F Y"),
		], 200);
		exit;
	}

	/**
	 * @return void
	 */
	private function privateTopicCount(): void
	{
		$db = new Database;
		$a = $db->privateTopicCount($start = time() - (3600 * 3), time());
		$this->success([
			"count" => $a,
			"start_date" => date("d F Y", $start),
			"end_date" => date("d F Y"),
		], 200);
		exit;
	}

	/**
	 * @return void
	 */
	private function getStatus(): void
	{
		if (!isset($_GET["session_name"])) {
			$this->error("You need to provide the \"session_name\" parameter");
		}

		if (!is_string($_GET["session_name"])) {
			$this->error("\"session_name\" parameter must be a string");
		}

		$sessionFile = STORAGE_PATH."/telegram_sessions/".$_GET["session_name"];

		if (!file_exists($sessionFile)) {
			$this->error("\"{$sessionFile}\" does not exists");
		}

		$pidFile = STORAGE_PATH."/pid/{$_GET['session_name']}.pid";

		if (file_exists($pidFile)) {
			$pidData = json_decode(file_get_contents($pidFile), true);
			if (!is_array($pidData) || $pidData===[]) {
				$this->success(["status" => "off"]);	
			}
			$this->success(
				[
					"status" => "on",
					"pid" => $pidData
				]
			);
		} else {
			$this->success(["status" => "off"]);
		}
	}

	/**
	 * @return void
	 */
	private function killDaemon(): void
	{
		if (!isset($_GET["session_name"])) {
			$this->error("You need to provide the \"session_name\" parameter");
		}

		$sessionFile = STORAGE_PATH."/telegram_sessions/".$_GET["session_name"];

		if (!file_exists($sessionFile)) {
			$this->error("\"{$sessionFile}\" does not exists");
		}

		$pidFile = STORAGE_PATH."/pid/{$_GET['session_name']}.pid";

		$started = true;

		if (file_exists($pidFile)) {
			$pidData = json_decode(file_get_contents($pidFile), true);
			if (!is_array($pidData) || $pidData===[]) {
				$started = false;
				$msg = "There is no process to be killed";
			} else {
				$msg = count($pidData)." processes has been killed";
				foreach ($pidData as $pid) {
					for ($i=0; $i < 5; $i++) {
						shell_exec("nohup kill -KILL {$pid} >> /dev/null 2>&1");
					}
				}
				sleep(1);
			}
		} else {
			$started = false;
			$msg = "There is no process to be killed";
		}

		if ($started) {
			
		}

		$out = "Could not kill the daemon";

		if (!file_exists($pidFile)) {
			$this->success(
				[
					"status" => "success",
					"message" => $msg
				]
			);
		} else {
			if (!is_array($pidData) || $pidData===[]) {
				unlink($pidFile);
				$this->success(
					[
						"status" => "success",
						"message" => $msg
					]
				);
			}
			$this->success(
				[
					"status" => "failed",
					"out" => $out
				]
			);
		}
	}

	/**
	 * @return void
	 */
	private function runDaemon(): void
	{
		if (!isset($_GET["session_name"])) {
			$this->error("You need to provide the \"session_name\" parameter");
		}

		$sessionFile = STORAGE_PATH."/telegram_sessions/".$_GET["session_name"];

		if (!file_exists($sessionFile)) {
			$this->error("\"{$sessionFile}\" does not exists");
		}

		$pidFile = STORAGE_PATH."/pid/{$_GET['session_name']}.pid";

		$start = false;

		if (file_exists($pidFile)) {
			$pidData = json_decode(file_get_contents($pidFile), true);
			if (!is_array($pidData) || $pidData===[]) {
				$start = true;
			}
		} else {
			$start = true;
		}

		if ($start) {
			$out = shell_exec("nohup /usr/bin/php7.2 ".BASEPATH."/bin/telegramd ".escapeshellarg($_GET["session_name"])." --daemonize --telegram-daemon --no-tty -f 1 2>&1 >> ".BASEPATH."/storage/logs/{$_GET['session_name']} 2>&1 &");
				
			// Give some delay to wait it reaches the pid handler.
			sleep(1);
			$msg = "Starting daemon success!";
		} else {
			$msg = "No action to daemon starter since the daemon has already been started!";
		}
		
		if (file_exists($pidFile)) {
			$pidData = json_decode(file_get_contents($pidFile), true);
			if (!is_array($pidData) || $pidData===[]) {
				$this->success(["status" => "off"]);	
			}
			$this->success(
				[
					"status" => "success",
					"message" => $msg,
					"pid" => $pidData
				]
			);
		} else {
			$this->success(
				[
					"status" => "failed",
					"out" => $out
				]
			);
		}
	}

	/**
	 * @param mixed  $msg
	 * @param int    $code
	 * @return void
	 */
	public function success($msg, $code = 200): void
	{
		http_response_code($code);
		header("Content-Type: application/json");

		print json_encode(
			[
				"status" => "success",
				"message" => $msg
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
		);
		exit(0);
	}

	/**
	 * @param mixed $msg
	 * @param int   $code
	 * @return void
	 */
	private function error($msg, int $code = 400): void
	{
		http_response_code($code);
		header("Content-Type: application/json");

		print json_encode(
			[
				"status" => "error",
				"message" => $msg
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
		);
		exit(1);
	}
}
