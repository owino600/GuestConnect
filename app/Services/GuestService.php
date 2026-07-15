<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\GuestRepository;

class GuestService extends Service
{
    private SurveyService $surveyService;
    private GuestSessionService $sessionService;

    public function __construct(
        private GuestRepository $repository = new GuestRepository()
    ) {
        $this->surveyService = new SurveyService();
        $this->sessionService = new GuestSessionService();
    }

    public function register(string $mac): array
    {
        $guest = $this->repository->findByMac($mac);

        if (!$guest) {

            $this->repository->create($mac);

            $guest = $this->repository->findByMac($mac);

            $this->surveyService->ensureGuest(
                (int)$guest['id']
            );

            $this->sessionService->startSession(
                $guest['id'],
                'unifi'
            );

            return [

                'new' => true,

                'guest' => $guest,

                'showSurvey' => false

            ];
        }

        $this->repository->incrementVisits($mac);

        $guest = $this->repository->findByMac($mac);

        $this->surveyService->ensureGuest(
            (int)$guest['id']
        );

        $this->sessionService->startSession(
            $guest['id'],
            'unifi'
        );

        return [

            'new' => false,

            'guest' => $guest,

            'showSurvey' => $this->surveyService->shouldShowSurvey(
                $guest['id']
            )

        ];
    }
}
