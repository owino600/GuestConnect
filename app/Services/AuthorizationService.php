<?php

namespace GuestConnect\Services;

class AuthorizationService
{
    private UniFiService $uniFi;

    public function __construct()
    {
        $this->uniFi = new UniFiService();
    }

    public function authorizeGuest(string $mac): bool
    {
        return $this->uniFi->authorizeGuest($mac);
    }
}
