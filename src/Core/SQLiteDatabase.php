<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;
use RuntimeException;

class SQLiteDatabase
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

        if (!extension_loaded('pdo_sqlite')) {
            throw new RuntimeException('pdo_sqlite extension is not enabled');
        }

        $cfg = Config::get('database.sqlite');
        $file = $cfg['file'];
        $dir = dirname($file);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_TIMEOUT => $cfg['timeout'] ?? 5,
        ];

        self::$pdo = new PDO('sqlite:' . $file, null, null, $options);
        self::$pdo->exec("PRAGMA journal_mode = WAL");
        self::$pdo->exec("PRAGMA synchronous = NORMAL");

        self::initSchema();

        return self::$pdo;
    }

    private static function initSchema(): void
    {
        $db = self::$pdo;
        $db->exec("CREATE TABLE IF NOT EXISTS download_queue (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            track_id TEXT NOT NULL,
            status TEXT NOT NULL DEFAULT 'pending',
            file_path TEXT,
            quality TEXT,
            added_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            started_at DATETIME,
            completed_at DATETIME,
            error_message TEXT,
            retry_count INTEGER DEFAULT 0,
            priority INTEGER DEFAULT 0,
            percent INTEGER DEFAULT 0,
            telegram_user_id TEXT,
            telegram_message_id TEXT
        )");
        $db->exec("CREATE INDEX IF NOT EXISTS idx_download_status ON download_queue(status)");
        $db->exec("CREATE INDEX IF NOT EXISTS idx_download_track ON download_queue(track_id)");

        $db->exec("CREATE TABLE IF NOT EXISTS download_targets (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            download_id INTEGER NOT NULL,
            track_id TEXT NOT NULL,
            telegram_chat_id TEXT,
            telegram_user_id TEXT,
            telegram_message_id TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE(download_id, telegram_chat_id, telegram_message_id)
        )");
        $db->exec("CREATE INDEX IF NOT EXISTS idx_targets_download ON download_targets(download_id)");
        $db->exec("CREATE INDEX IF NOT EXISTS idx_targets_track ON download_targets(track_id)");
    }

    public static function prepare(string $sql): PDOStatement
    {
        if (!isset(self::$statements[$sql])) {
            self::$statements[$sql] = self::getConnection()->prepare($sql);
        }
        return self::$statements[$sql];
    }
}
