<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Services\GuestService;

class PortalController extends Controller
{
    public function login(): void
    {
        $mac = $_GET['mac'] ?? '';
        $ap = $_GET['ap'] ?? '';
        $ssid = $_GET['ssid'] ?? '';
        $url = $_GET['url'] ?? '';

        $guestService = new GuestService();

        $guest = null;
        $showSurvey = false;

        if (!empty($mac)) {

            $result = $guestService->register($mac);

            $guest = $result['guest'];
            $showSurvey = $result['showSurvey'];
        }

        $this->view('portal', [
            'guest' => $guest,
            'mac' => $mac,
            'ap' => $ap,
            'ssid' => $ssid,
            'url' => $url,
            'showSurvey' => $showSurvey
        ]);
    }
}
