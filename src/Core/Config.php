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
