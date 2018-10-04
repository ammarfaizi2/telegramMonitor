<?php

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 */
class TelegramMonitoringUI
{	
	/**
	 * @var array
	 */
	private $sessions = [];

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->sessions = array_filter(
			scandir(STORAGE_PATH."/telegram_sessions"), function ($f) {
			return !preg_match("/(^\.)|(\.lock$)/", $f);
		});
	}

	/**
	 * @return array
	 */
	public function getSessions(): array
	{
		$results = [];
		foreach ($this->sessions as $v) {
			$results[] = [
				"name" => $v,
				"status" => 
			];
		}
		return $this->sessions;
	}
}
