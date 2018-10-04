<?php

namespace TelegramDaemon;

use PhpPy\PhpPy2;
use danog\MadelineProto\EventHandler as BaseEventHandler;

trait HandlerTrait
{
	/**
     * @param string $u
     * @return void
     */
    private function channelMsgHandle(array $u): void
    {
        if (
            $u["message"]["to_id"]["_"] !== "peerChannel" ||
            !isset($u["message"]["to_id"]["channel_id"])
        ) {
            return;
        }
        
        if (isset($u["message"]["media"]["_"])) {
            switch ($u["message"]["media"]["_"]) {
                case "messageMediaPhoto":
                    $this->channelPhotoHandler($u);
                    break;
                case "messageMediaDocument":
                    $this->channelDocumentHandler($u);
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
                $py2 = new PhpPy2;
                $sentiment = trim($py2->run("sentistrength_id.py", $u["message"]["message"]));
                print $sentiment."\n\n";
                print $db->insertChannelMessage(
                    $a = [
                        "user_id" => $u["message"]["from_id"],
                        "message_id" => $u["message"]["id"],
                        "channel_id" => $u["message"]["to_id"]["channel_id"],
                        "reply_to_msg_id" => (
                            isset($u["message"]["reply_to_msg_id"]) ?
                                $u["message"]["reply_to_msg_id"] :
                                    null
                        ),
                        "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                        "unix_date" => $u["message"]["date"],
                        "message_type" => "text",
                        "text" => $u["message"]["message"],
                        "sentiment" => json_decode($sentiment, true),
                        "pts" => $u["pts"],
                        "pts_count" => $u["pts_count"],
                        "files" => []
                    ]
                )."\n";
            }

        }
    }

    /**
     * @param string $u
     * @return void
     */
    private function privateMsgHandle(array $u): void
    {
        if (isset($u["message"]["media"]["_"])) {

            switch ($u["message"]["media"]["_"]) {
                case "messageMediaPhoto":
                    $this->privatePhotoHandler($u);
                    break;
                case "messageMediaDocument":
                    $this->privateDocumentHandler($u);
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
                print $db->insertPrivateMessage(
                    $a = [
                        "user_id" => $u["message"]["from_id"],
                        "message_id" => $u["message"]["id"],
                        "reply_to_msg_id" => (
                            isset($u["message"]["reply_to_msg_id"]) ?
                                $u["message"]["reply_to_msg_id"] :
                                    null
                        ),
                        "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                        "unix_date" => $u["message"]["date"],
                        "message_type" => "text",
                        "text" => $u["message"]["message"],
                        "pts" => $u["pts"],
                        "pts_count" => $u["pts_count"],
                        "files" => []
                    ]
                )."\n";
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
    private function channelPhotoHandler(array $u): void
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
            $db = new Database;
            print $db->insertChannelMessage(
                [
                    "user_id" => $u["message"]["from_id"],
                    "message_id" => $u["message"]["id"],
                    "channel_id" => $u["message"]["to_id"]["channel_id"],
                    "reply_to_msg_id" => (
                        isset($u["message"]["reply_to_msg_id"]) ?
                            $u["message"]["reply_to_msg_id"] :
                                null
                    ),
                    "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                    "unix_date" => $u["message"]["date"],
                    "message_type" => "photo",
                    "text" => (isset($u["message"]["message"]) ? $u["message"]["message"] : ""),
                    "pts" => $u["pts"],
                    "pts_count" => $u["pts_count"],
                    "files" => [$file]
                ]
            )."\n";
        }
    }

    /**
     * Download document.
     *
     * @param array $u
     * @return void
     */
    private function channelDocumentHandler(array $u): void
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
                    case "video/mp4":
                        $ext = "mp4";
                        $type = "video";
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
                print $db->insertChannelMessage(
                    [
                        "user_id" => $u["message"]["from_id"],
                        "message_id" => $u["message"]["id"],
                        "channel_id" => $u["message"]["to_id"]["channel_id"],
                        "reply_to_msg_id" => (
                            isset($u["message"]["reply_to_msg_id"]) ?
                                $u["message"]["reply_to_msg_id"] :
                                    null
                        ),
                        "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                        "unix_date" => $u["message"]["date"],
                        "message_type" => $type,
                        "text" => (isset($u["message"]["message"]) ? $u["message"]["message"] : ""),
                        "pts" => $u["pts"],
                        "pts_count" => $u["pts_count"],
                        "files" => [$file]
                    ]
                )."\n";
            }

        }
    }

    /**
     * Download photo.
     *
     * @param array $u
     * @return void
     */
    private function privatePhotoHandler(array $u): void
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
            $db = new Database;
            print $db->insertPrivateMessage(
                [
                    "user_id" => $u["message"]["from_id"],
                    "message_id" => $u["message"]["id"],
                    "reply_to_msg_id" => (
                        isset($u["message"]["reply_to_msg_id"]) ?
                            $u["message"]["reply_to_msg_id"] :
                                null
                    ),
                    "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                    "unix_date" => $u["message"]["date"],
                    "message_type" => "photo",
                    "text" => (isset($u["message"]["message"]) ? $u["message"]["message"] : ""),
                    "pts" => $u["pts"],
                    "pts_count" => $u["pts_count"],
                    "files" => [$file]
                ]
            )."\n";
        }
    }

    /**
     * Download document.
     *
     * @param array $u
     * @return void
     */
    private function privateDocumentHandler(array $u): void
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
                        "message_id" => $u["message"]["id"],
                        "reply_to_msg_id" => (
                            isset($u["message"]["reply_to_msg_id"]) ?
                                $u["message"]["reply_to_msg_id"] :
                                    null
                        ),
                        "date" => date("Y-m-d H:i:s", $u["message"]["date"]),
                        "unix_date" => $u["message"]["date"],
                        "message_type" => $type,
                        "text" => (isset($u["message"]["message"]) ? $u["message"]["message"] : ""),
                        "pts" => $u["pts"],
                        "pts_count" => $u["pts_count"],
                        "files" => [$file]
                    ]
                )."\n";
            }

        }
    }
}