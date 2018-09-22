<?php

namespace TelegramDaemon;

use danog\MadelineProto\EventHandler as BaseEventHandler;

defined("DEBUG_MODE") or define("DEBUG_MODE", true);

DEBUG_MODE or ob_start();

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
            $this->msgHandle($u);
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
        if (isset($u["message"]["media"]["_"])) {

            switch ($u["message"]["media"]["_"]) {
                case "messageMediaPhoto":
                    $this->photoHandler($u);
                    break;
                case "messageMediaDocument":
                    $this->documentHandler($u);
                    break;
                default:
                    break;
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

    /**
     * @param string $tmpFile
     * @param string $ext
     * @return bool
     */
    private function saveFiletoStorage(string $tmpFile, string $ext): bool
    {
        $hashfile = sha1_file($tmpFile)."_".md5_file($tmpFile);
        if (!file_exists(STORAGE_PATH."/files/{$hashfile}.{$ext}")) {
            $rn = rename(
                $tmpFile,
                STORAGE_PATH."/files/{$hashfile}.{$ext}"
            );

            for ($i=0; $i < 5; $i++) {
                $rn or $rn = rename(
                    $tmpFile,
                    STORAGE_PATH."/files/{$hashfile}.{$ext}"
                );
            }

            if (!$rn) {
                unlink($tmpFile);
                return false;
            }
        }
        return true;
    }

    /**
     * Download photo.
     *
     * @param array $u
     * @return void
     */
    private function photoHandler(array $u): void
    {
        if (isset($u["message"]["media"]["photo"])) {
            $hash = sha1(json_encode($u));
            $this->saveFiletoStorage(
                $this->download_to_file(
                    $u,
                    STORAGE_PATH."/tmp/files/{$hash}.jpg"
                ),
                "jpg"
            );
        }
    }

    /**
     * Download document.
     *
     * @param array $u
     * @return void
     */
    private function documentHandler(array $u): void
    {
        if (isset(
            $u["message"]["media"]["document"],
            $u["message"]["media"]["document"]["mime_type"]
        )) {
            if (isset($u["message"]["media"]["document"]["attributes"][0]["file_name"])) {
                $ext = explode(".", $u["message"]["media"]["document"]["attributes"][0]["file_name"]);
                $ext = strtolower($ext[count($ext) - 1]);
                $hash = sha1(json_encode($u));
            } else {
                $hash = sha1(json_encode($u));
                switch ($u["message"]["media"]["document"]["mime_type"]) {
                    case "image/webp":
                        $ext = "webp";
                        break;
                    case "audio/ogg":
                        $ext = "ogg";
                        break;
                    default:
                        $ext = null;
                        break;
                }
            }

            if (
                isset($u, $hash, $ext) &&
                is_array($u) &&
                is_string($hash) &&
                is_string($ext)
            ) {
                $this->saveFiletoStorage(
                    $this->download_to_file(
                        $u,
                        STORAGE_PATH."/tmp/files/{$hash}.{$ext}"
                    ),
                    $ext
                );
            }

        }
    }
}
