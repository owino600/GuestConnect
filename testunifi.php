<?php

require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "Controller: " . ($_ENV['UNIFI_CONTROLLER'] ?? 'NOT SET') . PHP_EOL;
echo "Username: " . ($_ENV['UNIFI_USERNAME'] ?? 'NOT SET') . PHP_EOL;

$service = new GuestConnect\Services\UniFiService();

echo $service->login()
    ? "Connected successfully\n"
    : "Connection failed\n";
