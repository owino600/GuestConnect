<?php

namespace GuestConnect\Services\Survey;

use GuestConnect\Services\SettingsService;
use GuestConnect\Services\Survey\Providers\FormbricksProvider;
use GuestConnect\Services\Survey\Providers\GoogleFormsProvider;
use GuestConnect\Services\Survey\Providers\MicrosoftFormsProvider;
use GuestConnect\Services\Survey\Providers\TypeformProvider;
use GuestConnect\Services\Survey\Providers\SurvicateProvider;
use GuestConnect\Services\Survey\Providers\CustomProvider;

class SurveyProviderFactory
{
    public static function create(): SurveyProviderInterface
    {
        SurveyProviderRegistry::register(
            "formbricks",
            FormbricksProvider::class
        );

        SurveyProviderRegistry::register(
            "google",
            GoogleFormsProvider::class
        );

        SurveyProviderRegistry::register(
            "microsoft",
            MicrosoftFormsProvider::class
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
