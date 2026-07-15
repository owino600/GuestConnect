<?php

require_once __DIR__ . '/app/bootstrap.php';

use GuestConnect\Services\SurveyService;

$guestId = 1;

$survey = new SurveyService();

echo "Initial Connected Time:\n";
echo $survey->getConnectedTime($guestId) . " seconds\n\n";

echo "Adding 1 hour...\n";
$survey->recordSession($guestId, 3600);

echo "Current Time:\n";
echo $survey->getConnectedTime($guestId) . " seconds\n\n";

echo "Adding another 2 hours...\n";
$survey->recordSession($guestId, 7200);

echo "Current Time:\n";
echo $survey->getConnectedTime($guestId) . " seconds\n\n";

echo "Adding another 3 hours...\n";
$survey->recordSession($guestId, 10800);

echo "Final Connected Time:\n";
echo $survey->getConnectedTime($guestId) . " seconds\n";
