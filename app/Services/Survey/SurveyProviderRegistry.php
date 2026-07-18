<?php

namespace GuestConnect\Services\Survey;

class SurveyProviderRegistry
{
    protected static array $providers = [];

    public static function register(
        string $key,
        string $class
    ): void {

        self::$providers[$key] = $class;

    }

    public static function get(
        string $key
    ): ?string {

        return self::$providers[$key] ?? null;

    }

    public static function all(): array
    {
        return self::$providers;
    }
}
