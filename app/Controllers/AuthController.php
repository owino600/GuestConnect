<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;

class AuthController extends Controller
{
    public function authorize(): void
    {
        $credential = $_POST['credential'] ?? '';

        $mac = $_POST['mac'] ?? '';

        $url = $_POST['url'] ?? '';

        $terms = isset($_POST['terms']);

        echo "<pre>";

        print_r([

            'credential' => $credential,

            'mac' => $mac,

            'url' => $url,

            'termsAccepted' => $terms

        ]);

        echo "</pre>";
    }
}
