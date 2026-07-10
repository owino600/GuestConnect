<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;
use PDO;

class AdminRepository
{
    public function findByUsername(string $username): ?array
    {
        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            "SELECT * FROM administrators
             WHERE username = ?"
        );

        $stmt->execute([$username]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        return $admin ?: null;
    }
}
