<?php

namespace GuestConnect\Services;

use GuestConnect\Contracts\ControllerInterface;
use GuestConnect\Controllers\Integrations\UniFi\UniFiController;

class ControllerManager
{
    public function getController(): ControllerInterface
    {
        $settings = new SettingsService();

        $controller = $settings->get(
            'controller',
            'unifi'
        );

        return match ($controller) {

            'unifi' => new UniFiController(),

            default => new UniFiController()

        };
    }
}
