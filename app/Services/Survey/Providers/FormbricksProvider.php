<?php

namespace GuestConnect\Services\Survey\Providers;

use GuestConnect\Services\Survey\SurveyProviderInterface;
use GuestConnect\Services\SettingsService;

class FormbricksProvider implements SurveyProviderInterface
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    public function getName(): string
    {
        return "formbricks";
    }

    public function getSupportedDisplayMethods(): array
    {
        return [

            "popup",

            "redirect",

            "modal"

        ];
    }

    public function getLaunchConfiguration(
        array $guest
    ): array {

        return [

            "provider" => "formbricks",

            "type" => "popup",

            "url" => trim(
                $this->settings->get("survey_url")
            ),

            "guest" => [

                "id" => $guest["id"],

                "mac" => $guest["mac_address"],

                "visits" => $guest["visits"]

            ]

        ];

    }
}
