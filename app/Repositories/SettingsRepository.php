<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;

class SettingsRepository
{
    public function get(string $key, mixed $default = null): mixed
    {
        $stmt = Database::connection()->prepare(
            "SELECT setting_value
             FROM settings
             WHERE setting_key = :key
             LIMIT 1"
        );

        $stmt->execute([
            'key' => $key
        ]);

        $setting = $stmt->fetch();

        return $setting
            ? $setting['setting_value']
            : $default;
    }

    public function set(string $key, mixed $value): void
    {
        $stmt = Database::connection()->prepare("
            INSERT INTO settings (setting_key, setting_value)
            VALUES (:key, :value)
            ON DUPLICATE KEY UPDATE
                setting_value = VALUES(setting_value)
        ");

        $stmt->execute([
            'key'   => $key,
            'value' => $value
        ]);
    }
}
