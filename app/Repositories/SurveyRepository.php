<?php

namespace GuestConnect\Repositories;

use GuestConnect\Core\Database;

class SurveyRepository
{
    public function getByGuestId(int $guestId): ?array
    {
        $stmt = Database::connection()->prepare(
            "SELECT *
             FROM guest_surveys
             WHERE guest_id = ?"
        );

        $stmt->execute([$guestId]);

        return $stmt->fetch() ?: null;
    }

    public function create(int $guestId): void
    {
        $stmt = Database::connection()->prepare(
            "INSERT INTO guest_surveys
            (
                guest_id,
                connected_seconds
            )
            VALUES
            (
                ?,0
            )"
        );

        $stmt->execute([$guestId]);
    }

    public function getConnectedSeconds(int $guestId): int
    {
        $survey = $this->getByGuestId($guestId);

        return $survey
            ? (int)$survey['connected_seconds']
            : 0;
    }

    public function addConnectedSeconds(int $guestId, int $seconds): void
    {
        $stmt = Database::connection()->prepare(
            "UPDATE guest_surveys
             SET connected_seconds = connected_seconds + ?
             WHERE guest_id = ?"
        );

        $stmt->execute([
            $seconds,
            $guestId
        ]);
    }

    public function markShown(
        int $guestId,
        string $provider,
        string $identifier
    ): void
    {
        $stmt = Database::connection()->prepare(
            "UPDATE guest_surveys
             SET
                survey_shown = 1,
                survey_last_shown = NOW()
             WHERE guest_id = ?"
        );

        $stmt->execute([
            $provider,
            $identifier,
            $guestId
        ]);
    }

    public function markCompleted(int $guestId): void
    {
        $stmt = Database::connection()->prepare(
            "UPDATE guest_surveys
             SET
                survey_completed = 1,
                survey_completed_at = NOW()
             WHERE guest_id = ?"
        );

        $stmt->execute([$guestId]);
    }

    public function findByGuest(int $guestId): ?array
    {
        return $this->getByGuestId($guestId);
    }

    public function getConnectedTime(int $guestId): int
    {
        return $this->getConnectedSeconds($guestId);
    }

    public function recordSession(int $guestId, int $seconds): void
    {
        $this->addConnectedSeconds($guestId, $seconds);
    }
}
