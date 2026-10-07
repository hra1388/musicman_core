-- SQLite Download Queue Migration: 001_create_download_queue_schema.sql

CREATE TABLE IF NOT EXISTS download_queue (
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
);

CREATE INDEX IF NOT EXISTS idx_download_status ON download_queue(status);
CREATE INDEX IF NOT EXISTS idx_download_track ON download_queue(track_id);

CREATE TABLE IF NOT EXISTS download_targets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    download_id INTEGER NOT NULL,
    track_id TEXT NOT NULL,
    telegram_chat_id TEXT,
    telegram_user_id TEXT,
    telegram_message_id TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(download_id, telegram_chat_id, telegram_message_id)
);

CREATE INDEX IF NOT EXISTS idx_targets_download ON download_targets(download_id);
CREATE INDEX IF NOT EXISTS idx_targets_track ON download_targets(track_id);
