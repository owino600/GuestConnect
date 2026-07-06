<?php

namespace GuestConnect\Core;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonoLogger;

class Logger
{
    private static ?MonoLogger $logger = null;

    public static function get(): MonoLogger
    {
        if (!self::$logger) {

            self::$logger = new MonoLogger('guestconnect');

            self::$logger->pushHandler(
                new StreamHandler(
                    dirname(__DIR__,2).'/storage/logs/app.log'
                )
            );

        }

        return self::$logger;
    }
}
