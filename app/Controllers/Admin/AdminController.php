<?php

namespace GuestConnect\Controllers\Admin;

use GuestConnect\Core\Controller;
use GuestConnect\Services\SettingsService;

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
}
