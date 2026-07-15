<?php

require_once __DIR__.'/app/bootstrap.php';

$monitor = new GuestConnect\Services\SessionMonitorService();

$monitor->run();

echo "Session monitor completed.\n";
