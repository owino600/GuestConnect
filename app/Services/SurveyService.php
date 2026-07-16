<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\SurveyRepository;

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

        $this->repository->addConnectedSeconds(
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
        $provider = $this->settings->get(
            'survey_provider',
            'formbricks'
        );

        $identifier = $this->settings->get(
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

        if ($survey['survey_completed']) {
            return false;
        }

        $settings = new SettingsService();

        $showOnce = (int)$settings->get('survey_show_once', 1);

        if ($showOnce && $survey['survey_shown']) {
            return false;
        }

        $delay = (int)$settings->get('survey_delay', 6);

        $unit = $settings->get('survey_unit', 'hours');

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

        return $survey['connected_seconds'] >= $threshold;
    }

}
