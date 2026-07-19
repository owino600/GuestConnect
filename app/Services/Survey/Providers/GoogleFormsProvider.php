<?php

namespace GuestConnect\Services\Survey\Providers;

use GuestConnect\Services\Survey\SurveyProviderInterface;
use GuestConnect\Services\SettingsService;

class GoogleFormsProvider implements SurveyProviderInterface
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    public function getName(): string
    {
        return "google";
    }

    public function getSupportedDisplayMethods(): array
    {
        return [

            "popup",

            "redirect"

        ];
    }

    public function getLaunchConfiguration(
        array $guest
    ): array {

        return [

            "url" => $this->settings->get(
                "google_form_url"
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
