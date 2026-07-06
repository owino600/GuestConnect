<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;
use PDO;

class GuestRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function findByMac(string $mac): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM guests WHERE mac_address = ?"
        );

        $stmt->execute([$mac]);

        return $stmt->fetch() ?: null;
    }

    public function create(string $mac): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO guests
            (mac_address, first_seen, last_seen)
            VALUES (?, NOW(), NOW())"
        );

        $stmt->execute([$mac]);
    }

    public function updateLastSeen(string $mac): void
    {
        $stmt = $this->db->prepare(
            "UPDATE guests
             SET last_seen = NOW()
             WHERE mac_address = ?"
        );

        $stmt->execute([$mac]);
    }
}
