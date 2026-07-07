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

        if (!isset($_POST['terms'])) {

            exit("Please accept the Terms & Conditions.");

        }

        $authentication = new AuthenticationService();

        $method = (new AuthMethodService())->getMethod();

        $repository = new LoginRepository();

        // Validate the credential
        if (!$authentication->validate($credential)) {

            $repository->create([
                'mac'    => $mac,
                'method' => $method['type'],
                'status' => 'FAILED'
            ]);

            exit("Invalid password.");

        }

        // Authorize the device on UniFi
        $authorization = new AuthorizationService();

        if (!$authorization->authorizeGuest($mac)) {

            $repository->create([
                'mac'    => $mac,
                'method' => $method['type'],
                'status' => 'FAILED'
            ]);

            exit("Unable to authorize device.");

        }

        // Record successful login
        $repository->create([
            'mac'    => $mac,
            'method' => $method['type'],
            'status' => 'SUCCESS'
        ]);

        echo "<h2>Authentication Successful</h2>";

        echo "<p>Your device has been authorized.</p>";

        if (!empty($url)) {

            echo "<p>Redirecting...</p>";

            header("Refresh:2; url=" . $url);

        }
    }
}
