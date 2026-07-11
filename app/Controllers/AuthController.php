<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Repositories\LoginRepository;
use GuestConnect\Services\AuthMethodService;
use GuestConnect\Services\AuthenticationService;
use GuestConnect\Services\AuthorizationService;

class AuthController extends Controller
{
    public function authorize(): void
    {
        $credential = trim($_POST['credential'] ?? '');
        $mac = $_POST['mac'] ?? '';
        $url = $_POST['url'] ?? '';

        // Ensure Terms & Conditions are accepted
        if (!isset($_POST['terms'])) {
            exit("Please accept the Terms & Conditions.");
        }

        $authentication = new AuthenticationService();
        $method = (new AuthMethodService())->getMethod();
        $repository = new LoginRepository();

        // Validate authentication
        if (!$authentication->validate($credential)) {

            $repository->create([
                'mac'    => $mac,
                'method' => $method['type'],
                'status' => 'FAILED'
            ]);

            $_SESSION['error'] = "Invalid Wi-Fi password.";

            header("Location: /login?mac=".$mac);

            exit;
        }


        // Authorize guest on UniFi
        $authorization = new AuthorizationService();

        if (!$authorization->authorize($mac)) {

            $repository->create([
                'mac'    => $mac,
                'method' => $method['type'],
                'status' => 'FAILED'
            ]);

            $_SESSION['error'] =
                "Unable to connect you to the network.";

            header("Location: /login?mac=".$mac);

            exit;
        }

        // Record successful login
        $repository->create([
            'mac'    => $mac,
            'method' => $method['type'],
            'status' => 'SUCCESS'
        ]);

        // Redirect guest
        if (!empty($url)) {
            header("Location: " . $url);
        } else {
            header("Location: /");
        }

        exit;
    }
}
