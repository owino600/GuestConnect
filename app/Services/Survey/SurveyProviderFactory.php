<?php

namespace GuestConnect\Services\Survey;

use GuestConnect\Services\SettingsService;
use GuestConnect\Services\Survey\Providers\FormbricksProvider;

class SurveyProviderFactory
{
    public static function create(): SurveyProviderInterface
    {
        SurveyProviderRegistry::register(
            "formbricks",
            FormbricksProvider::class
        );

        $settings = new SettingsService();

        $provider = strtolower(
            $settings->get("survey_provider") ?? "formbricks"
        );

        $class = SurveyProviderRegistry::get($provider);

        if (!$class) {

            $class = FormbricksProvider::class;

        }

        return new $class();

    }
}
