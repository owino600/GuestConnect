<?php

namespace GuestConnect\Services;

use GuestConnect\Core\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Cookie\CookieJar;

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

    public function login(): bool
    {
       $username = Config::get('UNIFI_USERNAME');
       $password = Config::get('UNIFI_PASSWORD');

           echo "Username = [$username]" . PHP_EOL;
           echo "Password = [$password]" . PHP_EOL;
           echo "Password Length = " . strlen($password) . PHP_EOL;

           try {

               $response = $this->client->post(
                   '/api/auth/login',
                   [
                      'json' => [
                         'username' => $username,
                         'password' => $password
                      ]
                   ]
              );

              echo "Status: ".$response->getStatusCode().PHP_EOL;

              return true;

           } catch (\Throwable $e) {

              echo $e->getMessage().PHP_EOL;

              return false;
           }
    }
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
                   'cmd' => 'authorize-guest',
                   'mac' => strtolower($mac),
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
               "Guest Authorization Failed: ".$e->getMessage()
           );

           return false;
    }
}
