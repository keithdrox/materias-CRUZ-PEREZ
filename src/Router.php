<?php
declare(strict_types=1);

class Router {
    private array $routes = [];

    public function addRoute(string $method, string $pattern, callable $handler): void {
        // Reemplazar params para regex si hay
        $pattern = str_replace('/', '\/', $pattern);
        $this->routes[] = [
            'method' => $method,
            'pattern' => '/^' . $pattern . '$/',
            'handler' => $handler
        ];
    }

    public function dispatch(string $method, string $uri): void {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches); // Quitar el match completo
                call_user_func_array($route['handler'], $matches);
                return;
            }
        }
        throw new Exception("Not Found");
    }
}
