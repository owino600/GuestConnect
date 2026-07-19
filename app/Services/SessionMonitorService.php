<?php

namespace GuestConnect\Services;

use GuestConnect\Repositories\GuestSessionRepository;
use GuestConnect\Repositories\GuestRepository;
use GuestConnect\Services\SurveyService;

class SessionMonitorService
{
    private GuestSessionRepository $sessions;

    private GuestRepository $guests;

    private ControllerManager $controllers;

    private SurveyService $survey;

    public function __construct()
    {
        $this->sessions = new GuestSessionRepository();

        $this->guests = new GuestRepository();

        $this->controllers = new ControllerManager();

        $this->survey = new SurveyService();
    }

    public function run(): void
    {
        $controller = $this->controllers->getController();

        $clients = $controller->getOnlineClients();

        /*
        |--------------------------------------------------------------------------
        | Build lookup table
        |--------------------------------------------------------------------------
        */

        $online = [];

        foreach ($clients as $client) {

            if (!empty($client['mac'])) {

                $online[strtolower($client['mac'])] = true;

            }

        }

        /*
        |--------------------------------------------------------------------------
        | Compare active sessions
        |--------------------------------------------------------------------------
        */

        $activeSessions = $this->sessions->getActiveSessions();

        foreach ($activeSessions as $session) {

            $guest = $this->guests->findById(
                $session['guest_id']
            );

            if (!$guest) {

                continue;

            }

            $elapsed = time() - strtotime($session['login_time']);

            $this->survey->updateCurrentSessionTime(
                $guest['id'],
                $elapsed
            );

            $mac = strtolower(
                $guest['mac_address']
            );

            /*
            |--------------------------------------------------------------------------
            | Guest disconnected
            |--------------------------------------------------------------------------
            */

            if (!isset($online[$mac])) {

                $duration = $this->sessions->closeActiveSession(
                    $guest['id']
                );

                if ($duration > 0) {

                    $this->survey->recordSession(

                        $guest['id'],

                        $duration

                    );

                }
                if (isset($online[$mac])) {

                    $duration = time() - strtotime($session['login_time']);

                    $this->survey->recordSession(
                        $guest['id'],
                        $duration
                    );

                    continue;
                }

            }

        }

    }

}
