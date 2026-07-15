<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\GuestSessionRepository;

class GuestSessionService
{
    private GuestSessionRepository $repository;

    public function __construct()
    {
        $this->repository = new GuestSessionRepository();
    }

    /**
     * Ensure guest has only one active session.
     */
    public function startSession(
        int $guestId,
        string $controller,
        ?string $sessionIdentifier = null
    ): void {

        $existing =
            $this->repository->getActiveSession($guestId);

        if ($existing) {
            return;
        }

        $this->repository->startSession(
            $guestId,
            $controller,
            $sessionIdentifier
        );
    }

    /**
     * Finish current session.
     */
    public function endSession(int $guestId): void
    {
        $session =
            $this->repository->getActiveSession($guestId);

        if (!$session) {
            return;
        }

        $this->repository->endSession(
            $session['id']
        );
    }

    public function getConnectedTime(
        int $guestId
    ): int {

        return $this->repository
            ->getTotalConnectedTime($guestId);
    }

    public function getHistory(
        int $guestId
    ): array {

        return $this->repository
            ->getSessions($guestId);
    }
}
