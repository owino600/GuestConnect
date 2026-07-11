<?php

use GuestConnect\Controllers\PortalController;
use GuestConnect\Controllers\TestController;
use GuestConnect\Controllers\UniFiController;
use GuestConnect\Controllers\AuthController;
use GuestConnect\Controllers\Admin\AdminController;

$router->get('/', [PortalController::class, 'login']);

$router->get('/login', [PortalController::class, 'login']);

$router->get('/guest/s/default', [PortalController::class, 'login']);
$router->get('/guest/s/default/', [PortalController::class, 'login']);

$router->post('/authorize', [AuthController::class, 'authorize']);

$router->get('/test/guest', [TestController::class, 'guest']);

$router->get('/test/unifi', [UniFiController::class, 'test']);
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/portal', [AdminController::class,'portal']);

$router->post('/admin/portal', [AdminController::class,'savePortal']);
$router->get('/admin/branding', [AdminController::class, 'branding']);
$router->post('/admin/branding', [AdminController::class, 'saveBranding']);
$router->get('/admin/authentication', [AdminController::class, 'authentication']);
$router->post('/admin/authentication', [AdminController::class, 'saveAuthentication']);
