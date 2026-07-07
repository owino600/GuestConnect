<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;

class LoginRepository
{
    public function create(array $data): void
    {
        $sql = "
            INSERT INTO login_sessions
            (
                mac_address,
                auth_method,
                status,
                ip_address
            )
            VALUES
            (
                :mac,
                :method,
                :status,
                :ip
            )
        ";

        $stmt = Database::connection()->prepare($sql);

        $stmt->execute([

            'mac' => $data['mac'],

            'method' => $data['method'],

            'status' => $data['status'],

            'ip' => $_SERVER['REMOTE_ADDR'] ?? null

        ]);
    }
}
