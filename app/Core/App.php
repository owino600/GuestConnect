<?php

namespace GuestConnect\Core;

class App
{
    public function run(): void
    {
        $router = new Router();

        require dirname(__DIR__, 2) . '/routes/web.php';

        $router->dispatch();
    }
}
