<?php

namespace GuestConnect\Services\Survey;

use GuestConnect\Services\Survey\Providers\FormbricksProvider;

class SurveyProviderFactory
{
    public static function create()
    {
        $provider = (new \GuestConnect\Services\SettingsService())
            ->get('survey_provider');

        return match ($provider) {

            'formbricks' => new FormbricksProvider(),

            default => new FormbricksProvider()

        };
    }
}
