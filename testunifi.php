<?php

require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$service = new GuestConnect\Services\UniFiService();

$mac = "ec:30:b3:47:d3:a4";   // replace with the MAC from your phone

var_dump($service->authorizeGuest($mac));
