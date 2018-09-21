<?php

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();

class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function onUpdateNewChannelMessage($update)
    {
        $this->onUpdateNewMessage($update);
    }

    public function onUpdateNewMessage($u)
    {
        var_dump($u);
        if ($u["_"] === "updateNewMessage") {
            $msg = $u["message"];
            $this->messages->sendMessage(
                [
                    "peer" => $msg["from_id"],
                    "message" => "Ok...",
                    "reply_to_message_id" => $msg["id"]
                ]
            );  
        }
    }
}


$MadelineProto->setEventHandler('\EventHandler');
$MadelineProto->loop(-1);
