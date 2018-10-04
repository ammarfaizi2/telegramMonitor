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

        $pid = 0;

        // $pid = pcntl_fork();

        // if ($pid === 0) {
        //     cli_set_process_title("getUserInfo --user-id={$u['message']['from_id']}");
        //     $vectorOfUser = $this->users->getUsers(
        //         [
        //             "id" => [
        //                 "user#{$u['message']['from_id']}"
        //             ]
        //         ]
        //     );
        //     $db = new Database;
        //     print $db->handleUserInfo(
        //         [
        //             "user_id" => $u['message']['from_id'],
        //             "info" => $vectorOfUser,
        //             "date" => date("Y-m-d H:i:s"),
        //             "unix_date" => time()
        //         ]
        //     );
        //     exit(0);
        // }

        // $pid = pcntl_fork();

        if ($pid === 0) {
            print "Processing channel info...\n";
            cli_set_process_title("getChannelInfo --channel-id={$u['message']['from_id']}");
            $vectorOfChannel = $this->users->getUsers(
                [
                    "id" => [
                        "channel#{$u['message']['to_id']['channel_id']}"
                    ]
                ]
            );
            $db = new Database;
            print $db->handleChannelInfo(
                [
                    "channel_id" => $u['message']['to_id']['channel_id'],
                    "info" => $vectorOfChannel,
                    "date" => date("Y-m-d H:i:s"),
                    "unix_date" => time()
                ]
            );
            var_dump(123);
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
        
        $pid = pcntl_fork();

        if ($pid === 0) {
            cli_set_process_title("getUserInfo --user={$u['message']['from_id']}");
            $vectorOfUser = $this->users->getUsers(
                [
                    "id" => [
                        "user#{$u['message']['from_id']}"
                    ]
                ]
            );
            $db = new Database;
            print $db->handleUserInfo(
                [
                    "user_id" => $u['message']['from_id'],
                    "info" => $vectorOfUser,
                    "date" => date("Y-m-d H:i:s"),
                    "unix_date" => time()
                ]
            );
            exit(0);
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
