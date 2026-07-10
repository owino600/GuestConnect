<?php

namespace GuestConnect\Services;

use GuestConnect\Core\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
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
            'cookies' => new CookieJar(),
            'timeout' => 15
        ]);
    }

    /**
     * Login to UniFi Controller
     */
    public function login(): bool
    {
        try {

            $this->client->post(
                '/api/auth/login',
                [
                    'json' => [
                        'username' => Config::get('UNIFI_USERNAME'),
                        'password' => Config::get('UNIFI_PASSWORD')
                    ]
                ]
            );

            return true;

        } catch (\Throwable $e) {

            (new LogService())->error(
                "UniFi Login Failed: " . $e->getMessage()
            );

            return false;
        }
    }

    /**
     * Authorize a guest device
     */
    public function authorizeGuest(string $mac): bool
    {
        if (!$this->login()) {
            return false;
        }

        $site = Config::get('UNIFI_SITE', 'default');

        try {

            $response = $this->client->post(
                "/proxy/network/api/s/{$site}/cmd/stamgr",
                [
                    'json' => [
                        'cmd'     => 'authorize-guest',
                        'mac'     => strtolower($mac),
                        'minutes' => (int) Config::get(
                            'UNIFI_AUTHORIZE_MINUTES',
                            1440
                        )
                    ]
                ]
            );

            return $response->getStatusCode() === 200;

        } catch (GuzzleException $e) {

            (new LogService())->error(
                "Guest Authorization Failed: " .
                $e->getMessage()
            );

            return false;
        }
    }

    /**
     * Get all currently connected clients
     */
    public function getOnlineClients(): array
    {
        if (!$this->login()) {
            return [];
        }

        $site = Config::get('UNIFI_SITE', 'default');

        try {

            $response = $this->client->get(
                "/proxy/network/api/s/{$site}/stat/sta"
            );

            $result = json_decode(
                $response->getBody()->getContents(),
                true
            );

            $clients = [];

            foreach ($result['data'] ?? $result as $client) {

                $clients[] = [

                    'hostname' => $client['hostname'] ?? 'Unknown',

                    'mac' => $client['mac'] ?? '',

                    'ip' => $client['ip'] ?? '',

                    'access_point' => $client['last_uplink_name'] ?? 'Unknown',

                    'ssid' => $client['essid'] ?? '',

                    'network' => $client['network'] ?? '',

                    'guest' => $client['is_guest'] ?? false,

                    'authorized' => $client['authorized'] ?? false,

                    'wired' => $client['is_wired'] ?? false,

                    'signal' => $client['signal'] ?? null,

                    'uptime' => $client['uptime'] ?? 0,

                    'first_seen' => $client['first_seen'] ?? null,

                    'last_seen' => $client['last_seen'] ?? null
                ];
            }

            return $clients;

        } catch (GuzzleException $e) {

            (new LogService())->error(
                "Unable to retrieve online clients: " .
                $e->getMessage()
            );

            return [];
        }
    }

    /**
     * Get the number of online clients
     */
    public function getOnlineClientCount(): int
    {
        return count($this->getOnlineClients());
    }
}
