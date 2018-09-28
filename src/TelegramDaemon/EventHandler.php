<?php

namespace TelegramDaemon;

use danog\MadelineProto\EventHandler as BaseEventHandler;

defined("DEBUG_MODE") or define("DEBUG_MODE", true);

DEBUG_MODE or ob_start();

is_dir(STORAGE_PATH."/files") or mkdir(STORAGE_PATH."/files");

if (!is_dir(STORAGE_PATH."/files")) {
    throw new TelegramDaemonException(sprintf(
        "Could not create files directory: %s", STORAGE_PATH."/filesb"
    ));
}

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @package \TelegramDaemon
 * @license MIT
 * @version 0.0.1
 */
class EventHandler extends BaseEventHandler
{
    use HandlerTrait;

    /**
     * @var \TelegramDaemon\Database
     */
    protected $db;

    /**
     * @param inherit
     *
     * Constructor
     */
    public function __construct(...$parameters)
    {
        parent::__construct(...$parameters);
    }

    /**
     * @param array $u
     */
    public function onUpdateNewChannelMessage(array $u): void
    {
        if (!file_exists(STORAGE_PATH."/tmp/files")) {
            mkdir(STORAGE_PATH."/tmp/files");
        }

        $pid = pcntl_fork();

        if ($pid === 0) {
            cli_set_process_title("getUserInfo --user={$u['message']['from_id']}");
            $db = new Database;
            $vectorOfUser = $this->users->getUsers(
                [
                    "id" => [
                        "user#{$u['message']['from_id']}"
                    ]
                ]
            );
            print json_encode($vectorOfUser, 128);
            exit(0);
        }
        
        if ($u["_"] === "updateNewChannelMessage") {
            DEBUG_MODE or ob_end_clean();

            if ($u["message"]["from_id"] != USER_ID) {

                print json_encode($u, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)."\n\n";

                DEBUG_MODE or ob_start();
                $this->channelMsgHandle($u);

            } else {
                printf("Skipping...\n");
            }
           
            DEBUG_MODE or ob_end_clean();
            DEBUG_MODE or ob_start();
        }
    }

    /**
     * @param array $u
     * @return void
     */
    public function onUpdateNewMessage(array $u): void
    {
        if (!file_exists(STORAGE_PATH."/tmp/files")) {
            mkdir(STORAGE_PATH."/tmp/files");
        }

        if ($u["_"] === "updateNewMessage") {
            DEBUG_MODE or ob_end_clean();
            
            DEBUG_MODE or ob_start();

            if ($u["message"]["from_id"] != USER_ID) {
                
                print json_encode($u, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)."\n\n";

                $this->privateMsgHandle($u);
            } else {
                printf("Skipping...\n");
            }
           
            DEBUG_MODE or ob_end_clean();
            DEBUG_MODE or ob_start();
        }
    }
}
