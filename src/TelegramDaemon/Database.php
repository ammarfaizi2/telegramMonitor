<?php

namespace TelegramDaemon;

use PhpPy\PhpPy;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @package \TelegramDaemon
 * @license MIT
 * @version 0.0.1
 */
final class Database
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->phppy = new PhpPy;
	}

	/**
	 * @param array $data
	 * @return string
	 */
	public function insertPrivateMessage(array $data): string
	{
		return $this->phppy->run(
			"insert_private_message.py",
			json_encode(
				$data,
				JSON_PRETTY_PRINT |
				JSON_UNESCAPED_SLASHES
			)
		);
	}

	/**
	 * @param array $data
	 * @return string
	 */
	public function handleUserInfo(array $data): string
	{
		return $this->phppy->run(
			"user_info_handler.py",
			json_encode(
				$data,
				JSON_PRETTY_PRINT |
				JSON_UNESCAPED_SLASHES
			)
		);
	}

	/**
	 * @param array $data
	 * @return string
	 */
	public function insertChannelMessage(array $data): string
	{
		return $this->phppy->run(
			"insert_channel_message.py",
			json_encode(
				$data,
				JSON_PRETTY_PRINT |
				JSON_UNESCAPED_SLASHES
			)
		);
	}
}
