<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\SurveyRepository;

class SurveyService
{
    private SurveyRepository $repository;
    private SettingsService $settings;

    public function __construct()
    {
        $this->repository = new SurveyRepository();
        $this->settings = new SettingsService();
    }

    /**
     * Ensure survey record exists.
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

        if ($seconds <= 0) {
            return;
        }

        $this->repository->addConnectedSeconds(
            $guestId,
            $seconds
        );
    }

    /**
     * Total accumulated connection time.
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

    /**
     * Decide if the survey should be shown.
     */
    public function shouldShowSurvey(int $guestId): bool
    {
        $this->ensureGuest($guestId);

        $survey = $this->repository->getByGuestId($guestId);

        if (!$survey) {
            return false;
        }

        // Already completed
        if (!empty($survey['survey_completed'])) {
            return false;
        }

        $showOnce = (int)$this->settings->get(
            'survey_show_once',
            1
        );

        if (
            $showOnce &&
            !empty($survey['survey_shown'])
        ) {
            return false;
        }

        $delay = (int)$this->settings->get(
            'survey_delay',
            6
        );

        $unit = strtolower(
            $this->settings->get(
                'survey_unit',
                'hours'
            )
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
                break;
        }

        return (
            (int)$survey['connected_seconds']
            >=
            $threshold
        );
    }

    /**
     * Mark survey as shown.
     */
    public function markShown(int $guestId): void
    {
        $this->repository->markShown($guestId);
    }

    /**
     * Mark survey as completed.
     */
    public function markCompleted(int $guestId): void
    {
        $this->repository->markCompleted($guestId);
    }
}
