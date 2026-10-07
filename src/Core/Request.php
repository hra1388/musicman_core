<?php

namespace App\Core;

class Request
{
    private string $method;
    private string $path;
    private array $params;
    private array $headers;

    public function __construct()
    {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        $knownBasePaths = ['/mm/api', '/api'];
        foreach ($knownBasePaths as $bp) {
            if (str_starts_with($rawPath, $bp)) {
                $rawPath = substr($rawPath, strlen($bp));
                break;
            }
        }
        $this->path = '/' . trim($rawPath, '/');

        $bodyParams = [];
        if (in_array($this->method, ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            $input = file_get_contents('php://input');
            if (!empty($input)) {
                $decoded = json_decode($input, true);
                if (is_array($decoded)) {
                    $bodyParams = $decoded;
                }
            }
            if (empty($bodyParams)) {
                $bodyParams = $_POST;
            }
        }

        $this->params = array_merge($_GET, $bodyParams);
        $this->headers = $this->parseHeaders();
    }

    private function parseHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = str_replace('_', '-', strtolower(substr($key, 5)));
                $headers[$name] = $value;
            }
        }
        return $headers;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }

    public function getHeader(string $name, ?string $default = null): ?string
    {
        $name = strtolower($name);
        return $this->headers[$name] ?? $default;
    }

    public function getAuthToken(): ?string
    {
        $authHeader = $this->getHeader('authorization');
        if ($authHeader && preg_match('/Bearer\s+(.+)$/i', $authHeader, $m)) {
            return trim($m[1]);
        }
        return $this->getHeader('x-api-token')
            ?? $this->getHeader('x-api-key')
            ?? $this->getParam('token');
    }
}
