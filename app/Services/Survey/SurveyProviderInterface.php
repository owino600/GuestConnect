<?php

namespace GuestConnect\Services\Survey;

interface SurveyProviderInterface
{
    /**
     * Provider name
     */
    public function getName(): string;

    /**
     * Build the configuration required by the frontend
     */
    public function getLaunchConfiguration(
        array $guest
    ): array;
}
