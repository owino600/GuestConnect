<?php

namespace GuestConnect\Services;

class AuthorizationService extends Service
{
    public function authorize(string $mac): bool
    {
        return (new UniFiService())
            ->authorizeGuest($mac);
    }
}
