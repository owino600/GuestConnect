<?php

namespace GuestConnect\Services;

use GuestConnect\Core\Config;

class SurveyService
{
    public function shouldShowSurvey(array $guest): bool
    {
        if (empty($guest['first_seen'])) {
            return false;
        }

        $firstSeen = new \DateTime($guest['first_seen']);
        $now = new \DateTime();

        $hoursConnected = ($now->getTimestamp() - $firstSeen->getTimestamp()) / 3600;

        if ($hoursConnected < Config::get('SURVEY_DELAY_HOURS', 48)) {
            return false;
        }

        return true;
    }
}
