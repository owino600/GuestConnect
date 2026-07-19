<?php

namespace GuestConnect\Controllers\Admin;

use GuestConnect\Core\Controller;
use GuestConnect\Services\SettingsService;
use GuestConnect\Core\Session;
use GuestConnect\Services\LogService;

class AdminController extends Controller
{
    public function dashboard(): void
    {
        $settings = new SettingsService();

        $unifi = new \GuestConnect\Services\UniFiService();

        $clients = $unifi->getOnlineClients();

        $authorized = array_filter($clients, function ($c) {
            return !empty($c['authorized']);
        });

        $aps = [];

        foreach ($clients as $client) {
            $aps[$client['access_point']] = true;
        }

        $this->adminView('dashboard', [

            'settings'    => $settings->all(),

            'online'      => count($clients),

            'authorized'  => count($authorized),

            'aps'         => count($aps),

            'today'       => count($clients), // we'll replace this with DB statistics later

            'recent'      => array_slice($clients, 0, 10)

       ]);
    }

    public function portal(): void
    {
        $settings = new SettingsService();

        $this->adminView('portal', [
            'settings' => $settings->all()
        ]);
    }

    public function savePortal(): void
    {
        $settings = new SettingsService();

        $settings->set(
            'portal_name',
            $_POST['portal_name'] ?? ''
        );

        $settings->set(
            'welcome_message',
            $_POST['welcome_message'] ?? ''
        );

        Session::flash(
            'success',
            'Portal settings saved successfully.'
        );

        header("Location: /admin/portal");
        exit;
    }

    public function branding(): void
    {
        $settings = new SettingsService();

        $this->adminView('branding', [
            'settings' => $settings->all()
        ]);
    }
    public function saveBranding(): void
    {
        $settings = new SettingsService();

        $settings->set('portal_name', $_POST['portal_name'] ?? '');

        $settings->set('welcome_heading', $_POST['welcome_heading'] ?? '');

        $settings->set('welcome_message', $_POST['welcome_message'] ?? '');

        $settings->set('primary_color', $_POST['primary_color'] ?? '#00695C');

        $settings->set('secondary_color', $_POST['secondary_color'] ?? '#FFFFFF');

        $settings->set('background_color', $_POST['background_color'] ?? '#f5f7fb');

        $uploadDir = __DIR__ . '/../../../public/images/uploads/';

        if (!is_dir($uploadDir)) {

            mkdir($uploadDir,0755,true);

        }

        /*
        |--------------------------------------------------------------------------
        | Delete Background
        |--------------------------------------------------------------------------
        */

        if(isset($_POST['delete_background'])){

            $current = $settings->all()['background_image'] ?? '';

            if($current && file_exists($uploadDir.$current)){

                unlink($uploadDir.$current);

            }

            $settings->set('background_image','');

        }

        /*
        |--------------------------------------------------------------------------
        | Reset Colour
        |--------------------------------------------------------------------------
        */

        if(isset($_POST['reset_background_colour'])){

            $settings->set(
                'background_color',
                '#f5f7fb'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Upload New Image
        |--------------------------------------------------------------------------
        */

        if(
            isset($_FILES['background_image']) &&
            $_FILES['background_image']['error']===UPLOAD_ERR_OK
        ){

            $extension=strtolower(
                pathinfo(
                    $_FILES['background_image']['name'],
                    PATHINFO_EXTENSION
                )
            );

            $allowed=['jpg','jpeg','png','webp'];

            if(in_array($extension,$allowed)){

                // remove old image first

                $current=$settings->all()['background_image'] ?? '';

                if($current && file_exists($uploadDir.$current)){

                    unlink($uploadDir.$current);

                }

                $filename='portal_background.'.$extension;

                move_uploaded_file(
                    $_FILES['background_image']['tmp_name'],
                    $uploadDir.$filename
                );

                $settings->set(
                    'background_image',
                    $filename
                );

            }

        }

        (new LogService())->info(
            'Branding updated.'
        );

        Session::flash(
            'success',
            'Branding settings saved successfully.'
        );

        header("Location: /admin/branding");

        exit;
    }

    public function authentication(): void
    {
        $settings = new SettingsService();

        $this->adminView('authentication', [
            'settings' => $settings->all()
        ]);
    }

    public function saveAuthentication(): void
    {
        $settings = new SettingsService();

        $settings->set(
            'authentication_type',
            $_POST['authentication_method'] ?? 'password'
        );

        $settings->set(
            'wifi_password',
            $_POST['wifi_password'] ?? ''
        );

        Session::flash(
            'success',
            'Authentication settings saved successfully.'
        );

        header("Location: /admin/authentication");
        exit;
    }

    public function activity(): void
    {
        $clients = (new \GuestConnect\Services\UniFiService())
            ->getOnlineClients();

        $this->adminView('activity', [
            'clients' => $clients
        ]);
    }

    public function surveys(): void
    {
        $settings = new SettingsService();

        $this->adminView('surveys', [
            'settings' => $settings->all()
        ]);
    }

    public function saveSurveys(): void
    {
        $settings = new SettingsService();

        /*
        |--------------------------------------------------------------------------
        | Provider
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'survey_provider',
            $_POST['survey_provider'] ?? 'formbricks'
        );

        /*
        |--------------------------------------------------------------------------
        | Display Method
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'survey_display_method',
            $_POST['survey_display_method'] ?? 'popup'
        );

        /*
        |--------------------------------------------------------------------------
        | Formbricks
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'survey_url',
            trim($_POST['survey_url'] ?? '')
        );

        $settings->set(
            'survey_environment_id',
            trim($_POST['survey_environment_id'] ?? '')
        );

        $settings->set(
            'survey_identifier',
            trim($_POST['survey_identifier'] ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | Google Forms
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'google_form_url',
            trim($_POST['google_form_url'] ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | Microsoft Forms
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'microsoft_form_url',
            trim($_POST['microsoft_form_url'] ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | Typeform
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'typeform_url',
            trim($_POST['typeform_url'] ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | Survicate
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'survicate_url',
            trim($_POST['survicate_url'] ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | Custom Survey
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'custom_survey_url',
            trim($_POST['custom_survey_url'] ?? '')
        );

        /*
        |--------------------------------------------------------------------------
        | Timing
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'survey_delay',
            (int)($_POST['survey_delay'] ?? 6)
        );

        $settings->set(
            'survey_unit',
            $_POST['survey_unit'] ?? 'hours'
        );

        /*
        |--------------------------------------------------------------------------
        | Behaviour
        |--------------------------------------------------------------------------
        */

        $settings->set(
            'survey_frequency',
            $_POST['survey_frequency'] ?? 'stay'
        );

        $settings->set(
            'survey_frequency_days',
            $_POST['survey_frequency_days'] ?? 2
       );

       $settings->set(
           'survey_frequency_visits',
           $_POST['survey_frequency_visits'] ?? 2
       );

       Session::flash(
           'success',
           'Survey settings saved successfully.'
       );

       header("Location: /admin/surveys");

       exit;
    }
}
