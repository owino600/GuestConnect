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

        $surveyProvider = null;

        $surveyIdentifier = null;

        $surveyUrl = null;

        if (!empty($mac)) {

            $result = $guestService->register($mac);

            $guest = $result['guest'];

            $showSurvey = $result['showSurvey'];

            if ($showSurvey) {

                $surveyProvider = $settings->get(
                    'survey_provider'
                );

                $surveyIdentifier = $settings->get(
                    'survey_identifier'
                );

                $surveyUrl = rtrim(
                    $settings->get('survey_url'),
                    '/'
                ) . '/' . $surveyIdentifier;

            } // closes if ($showSurvey)

        } // closes if (!empty($mac))

        $auth = $authService->getMethod();

        $this->view('portal', [

            'guest' => $guest,

            'mac' => $mac,

            'ap' => $ap,

            'ssid' => $ssid,

            'url' => $url,
            'token' => $token,

            'showSurvey' => $showSurvey,

            'surveyProvider' => $surveyProvider,

            'surveyIdentifier' => $surveyIdentifier,

            'surveyUrl' => $surveyUrl,

            'auth' => $auth,

            'settings' => $settings->all()

        ]);
    }
}
