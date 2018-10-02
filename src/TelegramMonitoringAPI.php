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

		$sh = trim(shell_exec("ps aux | grep php | grep telegramd | grep ".escapeshellarg($_GET["session_name"])." 2>&1"));
		$sh = explode("\n", $sh);
		
		if (count($sh) < 2) {
			$this->success(
				[
					"status" => "off"
				]
			);
		} else {
			$sh[1] = preg_split("/(?:[a-z0-9]+\s+)(\d+)(?:\D+)/Usi", $sh[0]);
			var_dump($sh[1]);die;
			$this->success(
				[
					"status" => "on",
					"pid" => (int)$sh[1][1]
				]
			);
		}

		// $this->success(
		// 	shell_exec("ps aux | grep php | grep telegramd | grep ".escapeshellarg($_GET["session_name"])." 2>&1")
		// );
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
