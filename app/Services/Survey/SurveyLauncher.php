<?php

namespace GuestConnect\Services\Survey;

use GuestConnect\Services\SurveyService;
use GuestConnect\Services\SettingsService;

class SurveyLauncher
{
    private SurveyService $surveyService;

    private SettingsService $settings;

    public function __construct()
    {
        $this->surveyService = new SurveyService();

        $this->settings = new SettingsService();
    }

    /**
     * Determine whether a survey should be launched.
     */
    public function launch(array $guest): array
    {
        if (
            empty($guest) ||
            !$this->surveyService->shouldShowSurvey($guest['id'])
        ) {
            return [
                'show' => false
            ];
        }

        $provider = SurveyProviderFactory::create();

        $identifier = $this->settings->get(
            'survey_identifier'
        );

        $config = $provider->getLaunchConfiguration(

            $this->settings->get('survey_environment_id'),

            $identifier,

            $guest

        );
        // Record that this survey has now been presented
        $this->surveyService->markShown(
            (int)$guest['id']
        );

        return [

            'show' => true,

            'provider' => $provider->getName(),

            'configuration' => $config

        ];
    }
}
