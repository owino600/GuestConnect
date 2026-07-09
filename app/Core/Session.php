<?php

namespace GuestConnect\Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function flash(string $key, string $message): void
    {
        self::start();

        $_SESSION['flash'][$key] = $message;
    }

    public static function getFlash(string $key): ?string
    {
        self::start();

        if (!isset($_SESSION['flash'][$key])) {
            return null;
        }

        $message = $_SESSION['flash'][$key];

        unset($_SESSION['flash'][$key]);

        return $message;
    }
}
