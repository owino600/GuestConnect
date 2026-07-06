<?php

use GuestConnect\Controllers\HomeController;

$router->get('/', [HomeController::class, 'index']);
