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

            'portal_name' => $this->get('portal_name'),

            'welcome_message' => $this->get('welcome_message'),

            'authentication_type' => $this->get('authentication_type'),

            'wifi_password' => $this->get('wifi_password'),

            'survey_enabled' => $this->get('survey_enabled'),

            'survey_delay_hours' => $this->get('survey_delay_hours'),

            'survey_reset_days' => $this->get('survey_reset_days'),

            'formbricks_url' => $this->get('formbricks_url'),

            'logo' => $this->get('logo'),

            'theme' => $this->get('theme')

        ];
    }
}
