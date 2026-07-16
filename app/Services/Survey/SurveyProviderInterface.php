<?php

namespace GuestConnect\Services\Survey;

interface SurveyProviderInterface
{
    /**
     * Provider name.
     */
    public function getName(): string;

    /**
     * Build the survey launch URL.
     */
    public function getLaunchUrl(
        string $identifier,
        array $guest = []
    ): string;

    /**
     * Notify provider that survey was completed.
     */
    public function markCompleted(
        array $payload
    ): bool;
}
