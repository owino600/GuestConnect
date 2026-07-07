<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\SettingsRepository;

class AuthMethodService
{
    private SettingsRepository $settings;

    public function __construct()
    {
        $this->settings = new SettingsRepository();
    }

    public function getMethod(): array
    {
        $type = $this->settings->get('authentication_type', 'password');

        return [

            'type' => $type,

            'label' => ucfirst($type),

            'placeholder' => 'Enter ' . ucfirst($type)

        ];
    }
}
