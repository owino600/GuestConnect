<?php

namespace GuestConnect\Events;

use GuestConnect\Services\SurveyService;

class SurveyListener
{
    public function handle(array $payload): void
    {
        $survey = new SurveyService();

        $survey->recordSession(

            $payload['guest_id'],

            $payload['seconds']

        );
    }
}
