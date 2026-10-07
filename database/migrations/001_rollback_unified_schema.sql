-- Rollback Migration: 001_rollback_unified_schema.sql

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `artist_wikidata`;
DROP TABLE IF EXISTS `blog_posts`;
DROP TABLE IF EXISTS `public_playlists`;
DROP TABLE IF EXISTS `tracks`;
DROP TABLE IF EXISTS `collections`;
DROP TABLE IF EXISTS `artists`;
DROP TABLE IF EXISTS `user_activities`;
DROP TABLE IF EXISTS `user_interactions`;
DROP TABLE IF EXISTS `users`;

SET FOREIGN_KEY_CHECKS = 1;
