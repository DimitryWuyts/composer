<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$from = "x@gmail.com";
$to = "dimiw1337@hotmail.com";
$subject = "Logger \Monolog\Handler\NativeMailerHandler";
$body = 'body';

if  (isset($_GET ['type'])) {
    $get = $_GET ['type'];
    $log = new Logger('logger');
    switch ($get) {

        case 'DEBUG':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/blue.log', Logger::DEBUG));
        // add records to the log
            $log->debug($_GET ['message']);
            break;
        case 'INFO':

            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/blue.log', Logger::INFO));
            // add records to the log
            $log->info($_GET ['message']);
            break;

        case 'NOTICE':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/blue.log', Logger::NOTICE));
            // add records to the log
            $log->notice($_GET ['message']);
            break;

        case 'WARNING':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/yellow.log', Logger::WARNING));
            // add records to the log
            $log->warning($_GET ['message']);
            break;

        case  'ERROR':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/red.log', Logger::ERROR));
            // add records to the log
            $log->error($_GET ['message']);
            $nativeMailerHandler = new \Monolog\Handler\NativeMailerHandler($to, $subject, $from,logger::ERROR);
            break;

        case 'CRITICAL':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/red.log', Logger::CRITICAL));
            // add records to the log
            $log->critical($_GET ['message']);
            $nativeMailerHandler = new \Monolog\Handler\NativeMailerHandler($to, $subject, $from,logger::CRITICAL);
            break;

        case 'ALERT':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/red.log', Logger::ALERT));
            // add records to the log
            $log->alert($_GET ['message']);
            $nativeMailerHandler = new \Monolog\Handler\NativeMailerHandler($to, $subject, $from,logger::ALERT);
            break;

        case 'EMERGENCY':
            $log->pushHandler(new StreamHandler(__DIR__ . '/logs/black.log', Logger::EMERGENCY));
            // add records to the log
            $log->emergency($_GET ['message']);
            $nativeMailerHandler = new \Monolog\Handler\NativeMailerHandler($to, $subject, $from,logger::EMERGENCY);
            break;
    }
}
require 'buttons.html';
