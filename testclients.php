<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$unifi = new GuestConnect\Services\UniFiService();

$clients = $unifi->getOnlineClients();

echo "Online Clients: " . count($clients) . PHP_EOL;

foreach (array_slice($clients, 0, 5) as $client) {

    echo PHP_EOL;

    echo "Hostname : " . $client['hostname'] . PHP_EOL;
    echo "MAC      : " . $client['mac'] . PHP_EOL;
    echo "IP       : " . $client['ip'] . PHP_EOL;
    echo "AP       : " . $client['access_point'] . PHP_EOL;
    echo "SSID     : " . $client['ssid'] . PHP_EOL;
}
