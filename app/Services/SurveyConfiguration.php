<?php

namespace GuestConnect\Services;

class SurveyConfiguration
{
    public string $provider;
    public string $identifier;
    public int $delay;
    public string $unit;
    public bool $showOnce;

    public function __construct()
    {
        $settings = new SettingsService();

        $this->provider = $settings->get('survey_provider', 'formbricks');

        $this->identifier = $settings->get('survey_identifier', 'guest-feedback');

        $this->delay = (int)$settings->get('survey_delay', 6);

        $this->unit = $settings->get('survey_unit', 'hours');

        $this->showOnce = (bool)$settings->get('survey_show_once', 1);
    }
}
