<?php

require __DIR__ . '/vendor/autoload.php';

use GuestConnect\Services\LogService;

$logger = new LogService();

$logger->info('GuestConnect logging test.');

echo "Log written successfully.\n";
