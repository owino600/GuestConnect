<?php

namespace GuestConnect\Entities;

class Guest
{
    public ?int $id = null;

    public string $macAddress;

    public string $firstSeen;

    public string $lastSeen;

    public bool $surveyShown = false;

    public bool $surveyCompleted = false;

    public ?string $lastSurveyDate = null;
}
