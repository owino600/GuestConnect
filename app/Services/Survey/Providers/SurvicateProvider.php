<?php

namespace GuestConnect\Services\Survey\Providers;

use GuestConnect\Services\Survey\SurveyProviderInterface;
use GuestConnect\Services\SettingsService;

class SurvicateProvider implements SurveyProviderInterface
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    public function getName(): string
    {
        return "survicate";
    }

    public function getSupportedDisplayMethods(): array
    {
        return [
            "popup",
            "redirect"
        ];
    }

    public function getLaunchConfiguration(array $guest): array
    {
        return [

            "url" => $this->settings->get(
                "survicate_url"
            ),

            "type" => $this->settings->get(
                "survey_display_method",
                "popup"
            ),

            "guest" => [

                "id" => $guest["id"],

                "mac" => $guest["mac_address"]

            ]

        ];
    }
}
