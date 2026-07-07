<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\SettingsRepository;

class AuthenticationService
{
    private SettingsRepository $settings;

    public function __construct()
    {
        $this->settings = new SettingsRepository();
    }

    public function validate(string $credential): bool
    {
        $password = $this->settings->get('wifi_password');

        return $credential === $password;
    }
}
