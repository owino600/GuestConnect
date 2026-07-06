<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;
use GuestConnect\Services\GuestService;

class TestController extends Controller
{
    public function guest(): void
    {
        $service = new GuestService();

        $result = $service->register("AA:BB:CC:DD:EE:FF");

        echo "<pre>";
        print_r($result);
    }
}
