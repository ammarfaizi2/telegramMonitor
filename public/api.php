<?php
require __DIR__."/../config/init.php";
require __DIR__."/../vendor/autoload.php";

$api = new TelegramMonitoringAPI;
$api->run();
