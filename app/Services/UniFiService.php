<?php

namespace GuestConnect\Services;

use GuestConnect\Core\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class UniFiService extends Service
{
    private Client $client;

    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(
            Config::get('UNIFI_CONTROLLER'),
            '/'
        );

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
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

            $response = $this->client->post(
                '/api/auth/login',
                [
                    'json' => [
                        'username' => Config::get('UNIFI_USERNAME'),
                        'password' => Config::get('UNIFI_PASSWORD')
                    ]
                ]
            );

            return $response->getStatusCode() === 200;

        } catch (GuzzleException) {

            return false;

        }
    }
    public function authorizeGuest(string $mac): bool
    {
        /*
         * Temporary.
         * Later this will call the UniFi API.
         */

       if (empty($mac)) {

           return false;

       }

       return true;
    }
}
