<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Services\GuestService;
use GuestConnect\Services\AuthMethodService;

class PortalController extends Controller
{
    public function login(): void
    {
        $mac = $_GET['mac'] ?? '';

        $ap = $_GET['ap'] ?? '';

        $ssid = $_GET['ssid'] ?? '';

        $url = $_GET['url'] ?? '';

        $guestService = new GuestService();

        $authService = new AuthMethodService();

        $guest = null;

        $showSurvey = false;

        if (!empty($mac)) {

            $result = $guestService->register($mac);

            $guest = $result['guest'];

            $showSurvey = $result['showSurvey'];
        }

        $auth = $authService->getMethod();

        $this->view('portal', [

            'guest' => $guest,

            'mac' => $mac,

            'ap' => $ap,

            'ssid' => $ssid,

            'url' => $url,

            'showSurvey' => $showSurvey,

            'auth' => $auth

        ]);
    }
}
