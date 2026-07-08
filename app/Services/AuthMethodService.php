<?php

namespace GuestConnect\Services;

class AuthMethodService
{
    private SettingsService $settings;

    public function __construct()
    {
        $this->settings = new SettingsService();
    }

    public function getMethod(): array
    {
        $type = $this->settings->get(
            'authentication_type',
            'password'
        );

        return [

            'type' => $type,

            'label' => ucfirst($type),

            'placeholder' => 'Enter ' . ucfirst($type)

        ];
    }
}
