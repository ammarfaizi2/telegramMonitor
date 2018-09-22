<?php

namespace TelegramDaemon;

use danog\MadelineProto\EventHandler as BaseEventHandler;

defined("DEBUG_MODE") or define("DEBUG_MODE", true);

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 * @version 0.0.1
 */
class EventHandler extends BaseEventHandler
{
    /**
     * @param inherit
     *
     * Constructor
     */
    public function __construct(...$parameters)
    {
        DEBUG_MODE or ob_start();
        parent::__construct(...$parameters);
        if (!file_exists(STORAGE_PATH."/tmp/files")) {
            mkdir(STORAGE_PATH."/tmp/files");
        }
    }

    /**
     * @param array $u
     */
    public function onUpdateNewChannelMessage(array $u): void
    {
        // Private message.
        if ($u["_"] === "updateNewMessage") {
            $this->onUpdateNewMessage($update);
        }

        // Channel message.
        if ($u["_"] === "updateNewChannelMessage") {

        }
    }

    /**
     * @param array $u
     * @return void
     */
    public function onUpdateNewMessage(array $u): void
    {
        DEBUG_MODE or ob_end_clean();

        var_dump($u);
        
        if ($u["message"]["from_id"] != USER_ID) {
            $this->msgHandle($u, $msg);
        } else {
            printf("Skipping...\n");
        }
       
        DEBUG_MODE or ob_start();
    }

    /**
     * @param string $u
     * @return void
     */
    private function msgHandle(array $u): void
    {
        if (
            isset($u["message"]["media"]["_"]) &&
            $u["message"]["media"]["_"]
        ) {
            $hash = sha1(json_encode($u));
            $out = $this->download_to_file(
                $u,
                STORAGE_PATH."/tmp/files/{$hash}.jpg"
            );

            $hashfile = sha1_file($out)."_".md5_file($out);
            if (!file_exists(STORAGE_PATH."/files/{$hashfile}.jpg")) {
                rename(
                    STORAGE_PATH."/tmp/files/{$hash}.jpg",
                    STORAGE_PATH."/files/{$hashfile}.jpg"
                );
            }
        }

        $this->messages->sendMessage(
            [
                "peer" => $u["message"]["from_id"],
                "message" => json_encode(
                    $u,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                ),
                "reply_to_message_id" => $u["message"]["id"]
            ]
        );
    }
}
