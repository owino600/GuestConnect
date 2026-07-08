<?php

namespace GuestConnect\Services;

class AuthenticationService
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    public function validate(string $credential): bool
    {
        return $credential ===
            $this->settings->get('wifi_password');
    }
}
