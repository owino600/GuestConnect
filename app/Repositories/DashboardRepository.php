<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;
use PDO;

class DashboardRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function todayGuests(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM guests
            WHERE DATE(first_seen)=CURDATE()
        ");

        return (int)$stmt->fetchColumn();
    }

    public function successfulLogins(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM login_sessions
            WHERE status='SUCCESS'
            AND DATE(login_time)=CURDATE()
        ");

        return (int)$stmt->fetchColumn();
    }

    public function failedLogins(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM login_sessions
            WHERE status='FAILED'
            AND DATE(login_time)=CURDATE()
        ");

        return (int)$stmt->fetchColumn();
    }

    public function pendingSurveys(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM guests
            WHERE survey_shown=1
            AND survey_completed=0
        ");

        return (int)$stmt->fetchColumn();
    }

    public function totalGuests(): int
    {
        $stmt = $this->db->query("
            SELECT COUNT(*)
            FROM guests
        ");

        return (int)$stmt->fetchColumn();
    }
}
