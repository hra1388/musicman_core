# Architecture Overview

## Clean Architecture & Modular Monolith

MusicMan is organized as a PSR-4 compliant Modular Monolith adhering to Clean Architecture principles:

- **Core (`src/Core`)**: Contains application framework components including Configuration (`Config`), Database Pool managers (`Database` for MySQL and `SQLiteDatabase` for local download queues), Request & Response HTTP wrappers, Router, and Application bootstrap.
- **Domain Models (`src/Models`)**: Enterprise domain models representing `User` (consolidated Users & Artists), `Track`, `Interaction` (consolidated Likes/Follows/Plays/Notes), `Activity`, `Playlist` (consolidated Playlists & Albums/Collections), and `BlogPost`.
- **Repositories (`src/Repositories`)**: Data access layer decoupling SQL persistence from controllers.
- **Controllers (`src/Controllers`)**: Application handlers managing HTTP requests and delivering JSON/XML responses.

## Consolidated Database Design

### 1. Primary MySQL Relational Database
Consolidates and normalizes entities:
- `users`: Merged accounts and catalog artist profiles (distinguished via `user_type` = 'user' | 'artist').
- `public_playlists`: Merged user playlists, AI playlists, and music albums/collections (distinguished via `collection_type` = 'playlist' | 'ai_playlist' | 'album').
- `user_interactions`: Consolidated generic table replacing fragmented likes, follows, plays, and notes tables (`entity_type`, `entity_id`, `interaction_type`, `interaction_value`).
- `user_activities`: Consolidated activity feed stream.
- `tracks`: Music track metadata.
- `blog_posts`: Content and SEO blog entries.
- `artist_wikidata`: Knowledge Graph metadata.

### 2. Dedicated SQLite Database
- `download_queue` & `download_targets`: Isolated SQLite file specifically designed for thread-safe asynchronous download queuing and background processing.
