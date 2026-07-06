<?php

namespace GuestConnect\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, callable|array $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, callable|array $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "<h1>404 - Page Not Found</h1>";
            return;
        }

        $action = $this->routes[$method][$uri];

        if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        [$controller, $method] = $action;

        $controller = new $controller();

        $controller->$method();
    }
}
