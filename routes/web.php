<?php

use GuestConnect\Controllers\HomeController;
use GuestConnect\Controllers\TestController;
use GuestConnect\Controllers\UniFiController;
use GuestConnect\Controllers\PortalController;
use GuestConnect\Controllers\AuthController;

// Make the portal the home page
$router->get('/', [PortalController::class, 'login']);

$router->get('/test/guest', [TestController::class, 'guest']);
$router->get('/test/unifi', [UniFiController::class, 'test']);

$router->get('/login', [PortalController::class, 'login']);

// We'll change this to POST later
$router->get('/authorize', [AuthController::class, 'authorize']);
