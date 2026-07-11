<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Services\GuestService;
use GuestConnect\Services\AuthMethodService;
use GuestConnect\Services\SettingsService;

class PortalController extends Controller
{
    public function login(): void
    {

        // UniFi 10.x sends id instead of mac
        $mac = $_GET['id']
            ?? $_GET['mac']
            ?? '';

        $ap = $_GET['ap'] ?? '';

        $ssid = $_GET['ssid'] ?? '';

        $url = $_GET['url'] ?? '';
        $token = $_GET['token'] ?? $_GET['t'] ?? '';

        $guestService = new GuestService();

        $authService = new AuthMethodService();

        $settings = new SettingsService();

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
            'token' => $token,

            'showSurvey' => $showSurvey,

            'auth' => $auth,

            'settings' => $settings->all()

        ]);
    }
}
