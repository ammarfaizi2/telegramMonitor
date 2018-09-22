<?php

namespace TelegramDaemon;

use danog\MadelineProto\EventHandler as BaseEventHandler;

defined("DEBUG_MODE") or define("DEBUG_MODE", true);

DEBUG_MODE or ob_start();

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @package \TelegramDaemon
 * @license MIT
 * @version 0.0.1
 */
class EventHandler extends BaseEventHandler
{
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

        } else {

            if (
                isset($u["message"]["message"]) && 
                is_string($u["message"]["message"]) &&
                $u["message"]["message"] !== ""
            ) {
                $db = new Database;
                $db->insertPrivateMessage(
                    [
                        "user_id" => $u["message"]["from_id"],
                        "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                        "unix_date" => $u["message"]["date"],
                        "message_type" => "text",
                        "text" => $u["message"]["message"],
                        "files" => []
                    ]
                );
            }

        }

        //
        // Debug message.
        //
        // Do not use this in public unless you are running a bot because it can causes a spam.
        //
        // $this->messages->sendMessage(
        //     [
        //         "peer" => $u["message"]["from_id"],
        //         "message" => json_encode(
        //             $u,
        //             JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        //         ),
        //         "reply_to_message_id" => $u["message"]["id"]
        //     ]
        // );
    }

    /**
     * @param string $tmpFile
     * @param string $ext
     * @return string
     */
    private function saveFiletoStorage(string $tmpFile, string $ext): string
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
        return $hashfile.".".$ext;
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
            $file = $this->saveFiletoStorage(
                $this->download_to_file(
                    $u,
                    STORAGE_PATH."/tmp/files/{$hash}.jpg"
                ),
                "jpg"
            );
            $this->db->insertPrivateMessage(
                [
                    "user_id" => $u["message"]["from_id"],
                    "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                    "unix_date" => $u["message"]["date"],
                    "message_type" => "photo",
                    "text" => (isset($u["message"]["message"]) ? $u["message"]["message"] : ""),
                    "files" => [$file]
                ]
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
                $type = "document";
            } else {
                $hash = sha1(json_encode($u));
                switch ($u["message"]["media"]["document"]["mime_type"]) {
                    case "image/webp":
                        $ext = "webp";
                        $type = "sticker";
                        break;
                    case "audio/ogg":
                        $ext = "ogg";
                        $type = "audio";
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
                $file = $this->saveFiletoStorage(
                    $this->download_to_file(
                        $u,
                        STORAGE_PATH."/tmp/files/{$hash}.{$ext}"
                    ),
                    $ext
                );
                $db = new Database;
                print $db->insertPrivateMessage(
                    [
                        "user_id" => $u["message"]["from_id"],
                        "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                        "unix_date" => $u["message"]["date"],
                        "message_type" => $type,
                        "text" => (isset($u["message"]["message"]) ? $u["message"]["message"] : ""),
                        "files" => [$file]
                    ]
                );
                die;
            }

        }
    }
}
