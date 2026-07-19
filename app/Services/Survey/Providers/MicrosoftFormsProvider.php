<?php

namespace GuestConnect\Services\Survey\Providers;

use GuestConnect\Services\Survey\SurveyProviderInterface;
use GuestConnect\Services\SettingsService;

class MicrosoftFormsProvider implements SurveyProviderInterface
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    public function getName(): string
    {
        return "microsoft";
    }

    public function getSupportedDisplayMethods(): array
    {
        return [
            "redirect"
        ];
    }

    public function getLaunchConfiguration(
        array $guest
    ): array {

        return [

            "url" => $this->settings->get(
                "microsoft_form_url"
            ),

            "type" => $this->settings->get(
                "survey_display_method",
                "redirect"
            ),

            "guest" => [

                "id" => $guest["id"],

                "mac" => $guest["mac_address"]

            ]

        ];

    }

}
