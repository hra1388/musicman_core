<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;
use RuntimeException;

class Database
{
    private static ?PDO $pdo = null;
    private static array $statements = [];

    public static function getConnection(): PDO
    {
        if (self::$pdo !== null) {
            try {
                self::$pdo->query("SELECT 1");
                return self::$pdo;
            } catch (PDOException $e) {
                self::$pdo = null;
            }
        }

        $cfg = Config::get('database.mysql');
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $cfg['host'],
            $cfg['port'],
            $cfg['dbname'],
            $cfg['charset']
        );

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => $cfg['persistent'] ?? true,
            PDO::ATTR_TIMEOUT => $cfg['timeout'] ?? 5,
        ];

        $lastException = null;
        $maxRetries = $cfg['max_retries'] ?? 2;

        for ($attempt = 0; $attempt <= $maxRetries; $attempt++) {
            try {
                self::$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], $options);
                self::$pdo->exec("SET NAMES " . ($cfg['charset'] ?? 'utf8mb4') . " COLLATE " . ($cfg['collation'] ?? 'utf8mb4_general_ci'));
                return self::$pdo;
            } catch (PDOException $e) {
                $lastException = $e;
                self::$pdo = null;
                if ($attempt < $maxRetries) {
                    usleep(100000 + ($attempt * 200000) + random_int(0, 500000));
                    continue;
                }
            }
        }

        throw $lastException ?? new RuntimeException("Database connection failed");
    }

    public static function prepare(string $sql): PDOStatement
    {
        if (!isset(self::$statements[$sql])) {
            self::$statements[$sql] = self::getConnection()->prepare($sql);
        }
        return self::$statements[$sql];
    }
}
