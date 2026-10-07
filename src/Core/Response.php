<?php

namespace App\Core;

class Response
{
    public static function json(mixed $data, int $status = 200): void
    {
        if (!is_int($status) || $status < 100 || $status > 599) {
            $status = 500;
        }

        if (!headers_sent()) {
            http_response_code($status);
            header('Content-Type: application/json; charset=utf-8');

            $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
            if ($origin) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Credentials: true');
                header('Vary: Origin');
            } else {
                header('Access-Control-Allow-Origin: *');
            }

            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Quality, Authorization, X-Session-Id, X-Visitor-Id, X-Api-Token, X-Api-Key');
            header('Cache-Control: no-store');
        }

        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function xml(string $xml, int $status = 200): void
    {
        if (!headers_sent()) {
            http_response_code($status);
            header('Content-Type: application/xml; charset=utf-8');
            header('Access-Control-Allow-Origin: *');
            header('Cache-Control: public, max-age=3600');
        }

        echo $xml;
        exit;
    }

    public static function error(string $message, int $status = 400, ?array $details = null): void
    {
        $payload = [
            'success' => false,
            'error' => $message,
        ];
        if ($details !== null) {
            $payload['details'] = $details;
        }
        self::json($payload, $status);
    }
}
