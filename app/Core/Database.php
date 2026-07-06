<?php

namespace GuestConnect\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connection(): PDO
    {
        if (self::$connection === null) {

            $dsn = sprintf(
                "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
                Config::get('DB_HOST'),
                Config::get('DB_PORT'),
                Config::get('DB_DATABASE')
            );

            try {

                self::$connection = new PDO(
                    $dsn,
                    Config::get('DB_USERNAME'),
                    Config::get('DB_PASSWORD'),
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );

            } catch (PDOException $e) {

                die("Database connection failed: " . $e->getMessage());

            }
        }

        return self::$connection;
    }
}
