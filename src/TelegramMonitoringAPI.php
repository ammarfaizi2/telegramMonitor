<?php

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
			default:
				$this->error("Method \"{$this->apiMethod}\" does not exist");
				break;
		}
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
	private function runDaemon(): void
	{
		shell_exec("nohup /usr/bin/php7.2 ".BASEPATH."/bin/telegramd ".escapeshellarg($_GET["session_name"])." --daemonize --telegram-daemon --no-tty -f 1 >> ".BASEPATH."/storage/logs/{$_GET['session_name']}");
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
