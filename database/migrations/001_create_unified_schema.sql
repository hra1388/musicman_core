-- Up Migration: 001_create_unified_schema.sql
-- Production-ready unified MySQL schema for MusicMan web service

SET FOREIGN_KEY_CHECKS = 0;

-- Consolidated Users & Artists table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_type` VARCHAR(32) NOT NULL DEFAULT 'user', -- 'user' or 'artist'
  `artist_id` VARCHAR(191) DEFAULT NULL, -- Apple/Catalog artist ID for artist profiles
  `provider` VARCHAR(32) NOT NULL DEFAULT 'local',
  `provider_id` VARCHAR(191) DEFAULT NULL,
  `email` VARCHAR(191) DEFAULT NULL,
  `password_hash` VARCHAR(255) DEFAULT NULL,
  `first_name` VARCHAR(191) NOT NULL DEFAULT '',
  `last_name` VARCHAR(191) NOT NULL DEFAULT '',
  `username` VARCHAR(191) NOT NULL DEFAULT '',
  `photo_url` TEXT DEFAULT NULL,
  `bio` TEXT DEFAULT NULL,
  `primary_genre_name` VARCHAR(100) DEFAULT NULL,
  `created_at` INT NOT NULL,
  `last_login` INT NOT NULL DEFAULT 0,
  `session_epoch` INT NOT NULL DEFAULT 1,
  `is_public` TINYINT(1) NOT NULL DEFAULT 1,
  UNIQUE KEY `uniq_artist_id` (`artist_id`),
  UNIQUE KEY `uniq_provider` (`provider`, `provider_id`),
  INDEX `idx_user_type` (`user_type`),
  INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Consolidated Playlists & Collections (Albums) table
CREATE TABLE IF NOT EXISTS `public_playlists` (
  `id` VARCHAR(64) PRIMARY KEY,
  `collection_type` VARCHAR(32) NOT NULL DEFAULT 'playlist', -- 'playlist', 'ai_playlist', 'album'
  `user_id` INT DEFAULT NULL,
  `slug` VARCHAR(191) DEFAULT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `cover` TEXT DEFAULT NULL,
  `icon` VARCHAR(60) NOT NULL DEFAULT 'bi-stars',
  `color` VARCHAR(30) NOT NULL DEFAULT 'primary',
  `ai_model` VARCHAR(100) DEFAULT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  `data` LONGTEXT NOT NULL,
  `views` INT NOT NULL DEFAULT 0,
  `track_count` INT NOT NULL DEFAULT 0,
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL,
  UNIQUE KEY `uniq_slug` (`slug`),
  INDEX `idx_collection_type` (`collection_type`),
  INDEX `idx_pl_user` (`user_id`),
  CONSTRAINT `fk_playlists_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Consolidated User Interactions table (Likes, Follows, Plays, Custom Values)
CREATE TABLE IF NOT EXISTS `user_interactions` (
  `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `entity_type` VARCHAR(32) NOT NULL, -- track, collection, user
  `entity_id` VARCHAR(191) NOT NULL,
  `interaction_type` VARCHAR(32) NOT NULL, -- like, follow, play, note, rating
  `interaction_value` LONGTEXT DEFAULT NULL,
  `created_at` INT NOT NULL,
  UNIQUE KEY `uniq_user_interaction` (`user_id`, `entity_type`, `entity_id`, `interaction_type`),
  INDEX `idx_user_type` (`user_id`, `interaction_type`),
  INDEX `idx_entity` (`entity_type`, `entity_id`),
  CONSTRAINT `fk_interactions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Consolidated User Activities Feed Table
CREATE TABLE IF NOT EXISTS `user_activities` (
  `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `action` VARCHAR(64) NOT NULL,
  `entity_type` VARCHAR(32) NOT NULL,
  `entity_id` VARCHAR(191) NOT NULL,
  `payload` LONGTEXT DEFAULT NULL,
  `created_at` INT NOT NULL,
  INDEX `idx_user_activity` (`user_id`, `created_at`),
  INDEX `idx_action` (`action`),
  CONSTRAINT `fk_activities_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tracks table
CREATE TABLE IF NOT EXISTS `tracks` (
  `track_id` VARCHAR(191) PRIMARY KEY,
  `track_name` VARCHAR(255) DEFAULT NULL,
  `artist_id` VARCHAR(191) DEFAULT NULL,
  `artist_name` VARCHAR(255) DEFAULT NULL,
  `collection_id` VARCHAR(191) DEFAULT NULL,
  `collection_name` VARCHAR(255) DEFAULT NULL,
  `is_streamable` TINYINT(1) NOT NULL DEFAULT 0,
  `views` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_track_artist` (`artist_id`),
  INDEX `idx_track_collection` (`collection_id`),
  INDEX `idx_track_views` (`views`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Blog posts table
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(191) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `excerpt` TEXT DEFAULT NULL,
  `content` LONGTEXT NOT NULL,
  `cover_image` TEXT DEFAULT NULL,
  `language` VARCHAR(10) NOT NULL DEFAULT 'en',
  `status` ENUM('draft', 'published', 'archived') NOT NULL DEFAULT 'draft',
  `meta_description` TEXT DEFAULT NULL,
  `meta_keywords` TEXT DEFAULT NULL,
  `ai_generated` TINYINT(1) NOT NULL DEFAULT 0,
  `ai_model` VARCHAR(100) DEFAULT NULL,
  `views` BIGINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published_at` DATETIME DEFAULT NULL,
  UNIQUE KEY `uniq_blog_slug` (`slug`),
  INDEX `idx_blog_status_published` (`status`, `published_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Artist Wikidata Table
CREATE TABLE IF NOT EXISTS `artist_wikidata` (
  `artist_id` VARCHAR(191) PRIMARY KEY,
  `qid` VARCHAR(32) DEFAULT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `long_description` LONGTEXT DEFAULT NULL,
  `birth_date` VARCHAR(50) DEFAULT NULL,
  `death_date` VARCHAR(50) DEFAULT NULL,
  `genres` LONGTEXT DEFAULT NULL,
  `image` TEXT DEFAULT NULL,
  `wikidata_url` TEXT DEFAULT NULL,
  `fetched_at` DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
