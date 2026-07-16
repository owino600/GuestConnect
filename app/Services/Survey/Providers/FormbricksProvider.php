<?php

namespace GuestConnect\Services\Survey\Providers;

class FormbricksProvider
{
    public function getName(): string
    {
        return 'formbricks';
    }

    public function getLaunchConfiguration(
        string $environmentId,
        string $surveyIdentifier,
        array $guest
    ): array {

        return [

            'environmentId' => $environmentId,

            'surveyIdentifier' => $surveyIdentifier,

            'guest' => [

                'id' => $guest['id'],

                'mac' => $guest['mac_address'],

                'visits' => $guest['visits']

            ]

        ];
    }
}
