# MusicMan API — High-Scale Music Streaming Web Service

Production-ready, PSR-4 Clean Architecture / Modular Monolith web service and database system built with PHP 8.3, MySQL, and SQLite.

## Features

- **Clean PSR-4 Architecture:** Organized into `src/Core`, `src/Models`, `src/Repositories`, `src/Controllers`.
- **Consolidated Schemas:**
  - **Users & Artists:** Merged into `users` (`user_type` = `user` | `artist`).
  - **Playlists & Albums:** Merged into `public_playlists` (`collection_type` = `playlist` | `ai_playlist` | `album`).
  - **User Interactions:** Consolidated likes, follows, plays, and notes into `user_interactions` (`entity_type`, `entity_id`, `interaction_type`, `interaction_value`).
- **Isolated Download Queue:** Local download management offloaded to a separate, fast SQLite database (`download_queue.sqlite`).
- **No-CLI Web Installer:** Includes `install.php` for web-based installation on shared hosting without Composer/CLI access.
- **OpenAPI 3.1 & Security:** OpenAPI specification (`docs/openapi.json`), OWASP Security Checklist (`docs/SECURITY_CHECKLIST.md`), Architecture (`docs/ARCHITECTURE.md`), and Deployment (`docs/DEPLOYMENT.md`).

---

## Web Installation (Shared Hosting / No SSH Access)

If you do not have SSH/CLI access to your server or Composer installed:

1. Upload the project files to your web hosting root directory.
2. Open your browser and navigate to `https://your-domain.com/install.php`.
3. Fill in your MySQL Database Host, Name, User, and Password.
4. Click **Install Database & Config**. The installer will:
   - Create all unified MySQL tables.
   - Initialize the SQLite download queue database.
   - Generate the `.env` configuration file automatically.
5. Delete or restrict access to `install.php` after installation.

---

## API Documentation

Interactive OpenAPI 3.1 specification is available at `docs/openapi.json`.

### Endpoints Overview

- `POST /auth/register` — Register a new account.
- `POST /auth/login` — Log in and receive auth token.
- `GET /search?term={query}` — Search tracks, albums, and artists.
- `POST /interaction/record` — Record a user interaction (like, follow, play, note).
- `GET /interaction/list?user_id={id}&type={type}` — List recorded interactions.
- `GET /pl/list` — List public playlists and albums.
- `GET /download/queue` — View download queue status.
- `GET /sitemap.xml` — Service XML sitemap index.

---

## Testing

Run the test runner via CLI:

```bash
php tests/runner.php
```
