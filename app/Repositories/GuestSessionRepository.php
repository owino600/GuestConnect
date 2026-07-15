<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;

class GuestSessionRepository
{
    /**
     * Get active session for a guest.
     */
    public function getActiveSession(int $guestId): ?array
    {
        $stmt = Database::connection()->prepare("
            SELECT *
            FROM guest_sessions
            WHERE guest_id = ?
            AND status='active'
            LIMIT 1
        ");

        $stmt->execute([$guestId]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Start a new session.
     */
    public function startSession(
        int $guestId,
        string $controller,
        ?string $sessionIdentifier = null
    ): int {

        $stmt = Database::connection()->prepare("
            INSERT INTO guest_sessions
            (
                guest_id,
                controller,
                session_identifier,
                login_time,
                status
            )
            VALUES
            (
                ?,
                ?,
                ?,
                NOW(),
                'active'
            )
        ");

        $stmt->execute([
            $guestId,
            $controller,
            $sessionIdentifier
        ]);

        return (int)Database::connection()->lastInsertId();
    }

    /**
     * End a session.
     */
    public function endSession(int $sessionId): void
    {
        $stmt = Database::connection()->prepare("
            UPDATE guest_sessions
            SET
                logout_time = NOW(),
                duration_seconds =
                    TIMESTAMPDIFF(
                        SECOND,
                        login_time,
                        NOW()
                    ),
                status='closed'
            WHERE id=?
        ");

        $stmt->execute([$sessionId]);
    }

    /**
     * Total connected time.
     */
    public function getTotalConnectedTime(int $guestId): int
    {
        $stmt = Database::connection()->prepare("
            SELECT
                COALESCE(
                    SUM(duration_seconds),
                    0
                ) AS total
            FROM guest_sessions
            WHERE guest_id=?
        ");

        $stmt->execute([$guestId]);

        return (int)$stmt->fetch()['total'];
    }

    /**
     * Session history.
     */
    public function getSessions(int $guestId): array
    {
        $stmt = Database::connection()->prepare("
            SELECT *
            FROM guest_sessions
            WHERE guest_id=?
            ORDER BY login_time DESC
        ");

        $stmt->execute([$guestId]);

        return $stmt->fetchAll();
    }

    /**
    * All active sessions.
    */
    public function getActiveSessions(): array
    {
        $stmt = Database::connection()->query("
            SELECT *
            FROM guest_sessions
            WHERE status='active'
        ");

        return $stmt->fetchAll();
    }

    /**
    * Close active session by guest.
    */
    public function closeActiveSession(int $guestId): int
    {
        $stmt = Database::connection()->prepare("
            SELECT *
            FROM guest_sessions
            WHERE guest_id = ?
            AND status = 'active'
            LIMIT 1
        ");

        $stmt->execute([$guestId]);

        $session = $stmt->fetch();

        if (!$session) {

            return 0;

        }

        $duration = time() - strtotime($session['login_time']);

        $update = Database::connection()->prepare("
            UPDATE guest_sessions
            SET

                logout_time = NOW(),

                duration_seconds = ?,

                status = 'closed'

            WHERE id = ?
        ");

        $update->execute([

            $duration,

            $session['id']

        ]);

        return $duration;
    }

    public function getSession(int $sessionId): ?array
    {
        $stmt = Database::connection()->prepare("
            SELECT *
            FROM guest_sessions
            WHERE id=?
        ");

        $stmt->execute([$sessionId]);

        return $stmt->fetch() ?: null;
    }
}
