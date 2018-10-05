<?php

namespace TelegramDaemon;

use Exception;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @package \TelegramDaemon
 * @license MIT
 * @version 0.0.1
 */
class TelegramDaemonException extends Exception
{
	/**
     * @param inherit
     *
     * Constructor
     */
	public function __construct(...$parameters)
	{
		parent::__construct(...$parameters);
	}
}
