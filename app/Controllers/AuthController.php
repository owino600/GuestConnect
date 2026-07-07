<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Services\UniFiService;

class AuthController extends Controller
{
    public function authorize(): void
    {
        $mac = $_GET['mac'] ?? '';
        $url = $_GET['url'] ?? '';

        $unifi = new UniFiService();

        if ($unifi->authorizeGuest($mac)) {

            if (!empty($url)) {
                header("Location: " . $url);
                exit;
            }

            echo "Internet Authorized.";

            return;
        }

        echo "Unable to authorize guest.";
    }
}
