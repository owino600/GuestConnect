<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\SurveyRepository;
use GuestConnect\Repositories\GuestSessionRepository;

class SurveyService
{
    private SurveyRepository $repository;

    public function __construct()
    {
        $this->repository = new SurveyRepository();
    }

    /**
     * Ensure a survey record exists.
     */
    public function ensureGuest(int $guestId): void
    {
        if (!$this->repository->getByGuestId($guestId)) {

            $this->repository->create($guestId);

        }
    }

    /**
     * Add connected time.
     */
    public function recordSession(int $guestId, int $seconds): void
    {
        $this->ensureGuest($guestId);

        /*
        |--------------------------------------------------------------------------
        | Ignore duplicate uptime
        |--------------------------------------------------------------------------
        */

        $survey = $this->repository->getByGuestId($guestId);

        $lastRecorded = (int)($survey['last_recorded_uptime'] ?? 0);

        if ($seconds <= $lastRecorded) {
            return;
        }

        $increment = $seconds - $lastRecorded;

        $this->repository->addConnectedSeconds(
            $guestId,
            $increment
        );

        $this->repository->updateRecordedUptime(
            $guestId,
            $seconds
        );
    }

    /**
     * Total accumulated time.
     */
    public function getConnectedTime(int $guestId): int
    {
        $this->ensureGuest($guestId);

        return $this->repository->getConnectedSeconds($guestId);
    }

    /**
     * Has survey been shown?
     */
    public function hasSurveyBeenShown(int $guestId): bool
    {
        $survey = $this->repository->getByGuestId($guestId);

        return !empty($survey['survey_shown']);
    }

    /**
     * Has survey been completed?
     */
    public function hasSurveyBeenCompleted(int $guestId): bool
    {
        $survey = $this->repository->getByGuestId($guestId);

        return !empty($survey['survey_completed']);
    }

    public function markShown(int $guestId): void
    {
        $settings = new SettingsService();

        $provider = $settings->get(
            'survey_provider',
            'formbricks'
        );

        $identifier = $settings->get(
            'survey_identifier',
            'guest-feedback'
        );

        $this->repository->markShown(
            $guestId,
            $provider,
            $identifier
        );
    }

    public function markCompleted(int $guestId): void
    {
        $this->repository->markCompleted($guestId);
    }

    public function shouldShowSurvey(int $guestId): bool
    {
        $survey = $this->repository->findByGuest($guestId);

        if (!$survey) {
            return false;
        }

        // Already completed
        if ($survey['survey_completed']) {
            return false;
        }

        $settings = new SettingsService();

        $showOnce = (int)$settings->get(
            'survey_show_once',
            1
        );

        if ($showOnce && $survey['survey_shown']) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Build Total Connected Time
        |--------------------------------------------------------------------------
        */

        $connectedSeconds = (int)$survey['connected_seconds'];

        $sessions = new GuestSessionRepository();

        $activeSession = $sessions->getActiveSession($guestId);

        if ($activeSession) {

            $connectedSeconds += (
                time() -
                strtotime($activeSession['login_time'])
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Delay
        |--------------------------------------------------------------------------
        */

        $delay = (int)$settings->get(
            'survey_delay',
            6
        );

        $unit = $settings->get(
            'survey_unit',
            'hours'
        );

        switch ($unit) {

            case 'minutes':

                $threshold = $delay * 60;

                break;

            case 'days':

                $threshold = $delay * 86400;

                break;

            default:

                $threshold = $delay * 3600;

        }

        return $connectedSeconds >= $threshold;
    }

    public function updateCurrentSessionTime(
        int $guestId,
        int $seconds
    ): void {

        $this->ensureGuest($guestId);

        $survey = $this->repository->getByGuestId($guestId);

        if (!$survey) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Only update if uptime increased
        |--------------------------------------------------------------------------
        */

        if ($seconds <= (int)$survey['last_recorded_uptime']) {
            return;
        }

        $difference =
            $seconds -
            (int)$survey['last_recorded_uptime'];

        $this->repository->updateCurrentSessionTime(
            $guestId,
            $difference,
            $seconds
        );
    }

}
