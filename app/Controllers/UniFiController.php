<?php

namespace GuestConnect\Services;

use GuestConnect\Core\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UniFiService extends Service
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => rtrim(Config::get('UNIFI_CONTROLLER'), '/'),
            'verify' => filter_var(
                Config::get('UNIFI_VERIFY_SSL', false),
                FILTER_VALIDATE_BOOLEAN
            ),
            'cookies' => true,
            'timeout' => 15
        ]);
    }

    public function login(): bool
    {
        try {

            $response = $this->client->post('/api/auth/login', [
                'json' => [
                    'username' => Config::get('UNIFI_USERNAME'),
                    'password' => Config::get('UNIFI_PASSWORD')
                ]
            ]);

            return $response->getStatusCode() === 200;

        } catch (GuzzleException) {

            return false;

        }
    }

    /**
     * Temporary placeholder.
     * Later this will call the UniFi API to authorize the client.
     */
    public function authorizeGuest(string $mac): bool
    {
        return true;
    }
}
