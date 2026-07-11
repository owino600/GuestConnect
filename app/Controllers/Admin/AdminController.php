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

         $this->adminView('dashboard', [
            'settings' => $settings->all()
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

        // Log the change
        $logger = new LogService();
        $logger->info('Branding settings updated.');

        //flash message
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
}
