<?php

namespace GuestConnect\Controllers;

use GuestConnect\Core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home');
    }
}
