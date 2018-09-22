<?php

define("DEBUG_MODE", true);
define("USER_ID", 562623987);

use danog\MadelineProto\API;
use danog\MadelineProto\EventHandler as BaseEventHandler;

if (!file_exists("madeline.php")) {
    copy("https://phar.madelineproto.xyz/madeline.php", "madeline.php");
}
require "madeline.php";

$MadelineProto = new API("session.madeline");
$MadelineProto->start();

DEBUG_MODE and ob_start();

class EventHandler extends BaseEventHandler
{
    public function onUpdateNewChannelMessage($update)
    {
        $this->onUpdateNewMessage($update);
    }

    public function onUpdateNewMessage($u)
    {
        DEBUG_MODE and ob_end_clean();

        if ($u["_"] === "updateNewMessage") {
            var_dump($u);
            $msg = $u["message"];
            if ($msg["from_id"] != USER_ID) {

                $this->msgHandle($u, $msg);
            } else {
                print "Skipping...\n";
            }
        } elseif ($u["_"] === "updateNewChannelMessage") {

        }
        DEBUG_MODE and ob_start();
    }

    private function msgHandle($u, $msg)
    {
        $this->messages->sendMessage(
            [
                "peer" => $msg["from_id"],
                "message" => json_encode(
                    $u, 
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                ),
                "reply_to_message_id" => $msg["id"]
            ]
        );
    }
}

$MadelineProto->setEventHandler("\EventHandler");
$MadelineProto->loop(3);
