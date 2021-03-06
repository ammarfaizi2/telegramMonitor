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
	 * @param int $startDate
	 * @param int $endDate
	 * @return int
	 */
	public function channelMessageCount(int $startDate, int $endDate): int
	{
		$out = (int)$this->phppy->run(
			"channel_message_counter.py",
			json_encode(
				[
					"start_date" => $startDate,
					"end_date" => $endDate
				],
				JSON_PRETTY_PRINT |
				JSON_UNESCAPED_SLASHES
			)
		);

		return $out;
	}

	/**
	 * @param int $startDate
	 * @param int $endDate
	 * @return int
	 */
	public function privateMessageCount(int $startDate, int $endDate): int
	{
		$out = (int)$this->phppy->run(
			"private_message_counter.py",
			json_encode(
				[
					"start_date" => $startDate,
					"end_date" => $endDate
				],
				JSON_PRETTY_PRINT |
				JSON_UNESCAPED_SLASHES
			)
		);

		return $out;
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
	public function handleChannelInfo(array $data): string
	{
		return $this->phppy->run(
			"channel_info_handler.py",
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
