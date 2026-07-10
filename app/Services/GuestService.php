<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\GuestRepository;

class GuestService extends Service
{
    private SurveyService $surveyService;

    public function __construct(
        private GuestRepository $repository = new GuestRepository()
    ) {
        $this->surveyService = new SurveyService();
    }

    public function register(string $mac): array
    {
        $guest = $this->repository->findByMac($mac);

        if (!$guest) {

            $this->repository->create($mac);

            $guest = $this->repository->findByMac($mac);

            return [
                'new' => true,
                'guest' => $guest,
                'showSurvey' => false
            ];
        }

        $this->repository->incrementVisits($mac);

        // Refresh guest data
        $guest = $this->repository->findByMac($mac);

        return [
            'new' => false,
            'guest' => $guest,
            'showSurvey' => $this->surveyService->shouldShowSurvey($guest)
        ];
    }
}
