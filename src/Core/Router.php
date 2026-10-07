<?php

namespace App\Core;

use Throwable;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, callable|array $handler, bool $auth = true): void
    {
        $key = strtoupper($method) . ' ' . $path;
        $this->routes[$key] = [
            'handler' => $handler,
            'auth' => $auth,
            'pattern' => false,
        ];
    }

    public function addPattern(string $method, string $regex, callable|array $handler, bool $auth = true): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'regex' => $regex,
            'handler' => $handler,
            'auth' => $auth,
            'pattern' => true,
        ];
    }

    public function dispatch(Request $request): void
    {
        if ($request->getMethod() === 'OPTIONS') {
            Response::json([], 200);
        }

        $method = $request->getMethod();
        $path = $request->getPath();

        // Direct key lookup
        $key = $method . ' ' . $path;
        if (isset($this->routes[$key])) {
            $this->executeRoute($this->routes[$key], $request);
            return;
        }

        // Pattern matching lookup
        foreach ($this->routes as $route) {
            if (!empty($route['pattern']) && $route['method'] === $method) {
                if (preg_match($route['regex'], $path, $matches)) {
                    $this->executeRoute($route, $request, $matches);
                    return;
                }
            }
        }

        Response::error('Endpoint not found', 404, ['path' => $path, 'method' => $method]);
    }

    private function executeRoute(array $route, Request $request, array $matches = []): void
    {
        try {
            $handler = $route['handler'];
            if (is_array($handler)) {
                [$class, $action] = $handler;
                $instance = new $class();
                $instance->$action($request, $matches);
            } else {
                call_user_func($handler, $request, $matches);
            }
        } catch (Throwable $e) {
            $code = $e->getCode();
            $status = (is_int($code) && $code >= 100 && $code <= 599) ? $code : 500;
            Response::error($e->getMessage(), $status);
        }
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
