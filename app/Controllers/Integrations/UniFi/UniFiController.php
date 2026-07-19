<?php

namespace GuestConnect\Controllers\Integrations\UniFi;

use GuestConnect\Contracts\ControllerInterface;
use GuestConnect\Services\UniFiService;

class UniFiController implements ControllerInterface
{
    private UniFiService $service;

    public function __construct()
    {
        $this->service = new UniFiService();
    }

    public function login(): bool
    {
        return $this->service->login();
    }

    public function authorizeGuest(string $mac): bool
    {
        return $this->service->authorizeGuest($mac);
    }

    public function disconnectGuest(string $mac): bool
    {
        // Coming later
        return true;
    }

    public function getOnlineClients(): array
    {
        return $this->service->getOnlineClients();
    }

    public function getName(): string
    {
        return 'unifi';
    }
}
