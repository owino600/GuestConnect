<?php

use GuestConnect\Controllers\HomeController;
use GuestConnect\Controllers\TestController;

$router->get('/', [HomeController::class, 'index']);

$router->get('/test/guest', [TestController::class, 'guest']);
