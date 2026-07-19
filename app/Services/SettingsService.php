<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\SettingsRepository;

class SettingsService
{
    private SettingsRepository $repository;

    public function __construct()
    {
        $this->repository = new SettingsRepository();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->repository->get($key, $default);
    }

    public function set(string $key, mixed $value): void
    {
        $this->repository->set($key, $value);
    }

    public function all(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Portal
            |--------------------------------------------------------------------------
            */

            'portal_name' => $this->get('portal_name'),

            'welcome_heading' => $this->get('welcome_heading'),

            'welcome_message' => $this->get('welcome_message'),

            'terms_conditions' => $this->get('terms_conditions'),

            /*
            |--------------------------------------------------------------------------
            | Authentication
            |--------------------------------------------------------------------------
            */

            'authentication_type' => $this->get('authentication_type'),

            'wifi_password' => $this->get('wifi_password'),

            /*
            |--------------------------------------------------------------------------
            | Survey
            |--------------------------------------------------------------------------
            */

            'survey_provider' => $this->get('survey_provider', 'formbricks'),

            'survey_display_method' => $this->get('survey_display_method', 'popup'),

            'survey_url' => $this->get('survey_url'),

            'survey_environment_id' => $this->get('survey_environment_id'),

            'survey_identifier' => $this->get('survey_identifier'),

            'google_form_url' => $this->get('google_form_url'),

            'microsoft_form_url' => $this->get('microsoft_form_url'),

            'typeform_url' => $this->get('typeform_url'),

            'survicate_url' => $this->get('survicate_url'),

            'custom_survey_url' => $this->get('custom_survey_url'),

            'survey_delay' => $this->get('survey_delay', 6),

            'survey_unit' => $this->get('survey_unit', 'hours'),

            'survey_show_once' => $this->get('survey_show_once', 0),

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */

            'logo' => $this->get('logo'),

            'background_image' => $this->get('background_image'),

            'background_color' => $this->get('background_color'),

            'primary_color' => $this->get('primary_color'),

            'secondary_color' => $this->get('secondary_color'),

            'theme' => $this->get('theme')

        ];
    }
}
