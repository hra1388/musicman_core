<?php

/**
 * PSR-4 Fallback Autoloader for environments without Composer CLI access.
 */
spl_autoload_register(function ($class) {
    $prefixes = [
        'App\\' => __DIR__ . '/src/',
        'Tests\\' => __DIR__ . '/tests/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            continue;
        }

        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require $file;
            return true;
        }
    }
    return false;
});
