<?php

namespace GuestConnect\Core;

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        require __DIR__ . "/../Views/{$view}.php";
    }

    protected function adminView(string $view, array $data = []): void
    {
        extract($data);

        require __DIR__ . "/../Views/admin/layouts/header.php";

        require __DIR__ . "/../Views/admin/layouts/sidebar.php";

        require __DIR__ . "/../Views/admin/{$view}.php";

        require __DIR__ . "/../Views/admin/layouts/footer.php";
    }
}
