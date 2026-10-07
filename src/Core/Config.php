<?php

namespace App\Core;

class Config
{
    private static array $items = [];

    public static function load(): void
    {
        if (!empty(self::$items)) {
            return;
        }

        // Parse .env file if present
        $envFile = __DIR__ . '/../../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) {
                    continue;
                }
                [$key, $value] = explode('=', trim($line), 2);
                $key = trim($key);
                $value = trim($value);
                if (!isset($_ENV[$key])) {
                    $_ENV[$key] = $value;
                }
            }
        }

        $appConfig = require __DIR__ . '/../../config/app.php';
        $dbConfig = require __DIR__ . '/../../config/database.php';

        self::$items = array_merge($appConfig, ['database' => $dbConfig]);
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::load();
        $parts = explode('.', $key);
        $value = self::$items;

        foreach ($parts as $part) {
            if (!is_array($value) || !array_key_exists($part, $value)) {
                return $default;
            }
            $value = $value[$part];
        }

        return $value;
    }
}
