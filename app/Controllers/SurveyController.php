<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Services\SurveyService;

class SurveyController extends Controller
{
    public function completed(): void
    {
        $guestId = (int)($_POST['guest_id'] ?? 0);

        if (!$guestId) {

            http_response_code(400);

            exit('Missing guest.');

        }

        $survey = new SurveyService();

        $survey->markCompleted($guestId);

        http_response_code(200);

        echo 'OK';
    }
}
