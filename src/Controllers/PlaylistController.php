<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;
use App\Core\Config;

class PlaylistController
{
    public function list(Request $request): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM public_playlists ORDER BY created_at DESC LIMIT 50");
        $items = $stmt->fetchAll();

        Response::json(['success' => true, 'count' => count($items), 'items' => $items]);
    }

    public function get(Request $request, array $matches = []): void
    {
        $id = $matches[1] ?? $request->getParam('id');
        if (!$id) {
            Response::error('Missing playlist ID', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM public_playlists WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        $playlist = $stmt->fetch();

        if (!$playlist) {
            Response::error('Playlist not found', 404);
        }

        $playlist['data'] = json_decode($playlist['data'] ?? '{}', true);
        Response::json(['ok' => true, 'playlist' => $playlist]);
    }

    public function publish(Request $request): void
    {
        $id = preg_replace('/[^A-Za-z0-9_\-]/', '', (string)$request->getParam('id', ''));
        $name = trim((string)$request->getParam('name', ''));
        $tracks = $request->getParam('tracks', []);

        if (!$id || !$name || !is_array($tracks)) {
            Response::error('Invalid playlist payload', 400);
        }

        $db = Database::getConnection();
        $now = time();
        $data = json_encode(['name' => $name, 'tracks' => $tracks], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $stmt = $db->prepare("
            INSERT INTO public_playlists (id, user_id, kind, name, description, cover, data, track_count, created_at, updated_at)
            VALUES (:id, :uid, 'user', :name, '', '', :data, :cnt, :now, :now)
            ON DUPLICATE KEY UPDATE name = VALUES(name), data = VALUES(data), track_count = VALUES(track_count), updated_at = VALUES(updated_at)
        ");
        $stmt->execute([
            ':id' => $id,
            ':uid' => Config::get('admin_user_id', 1),
            ':name' => $name,
            ':data' => $data,
            ':cnt' => count($tracks),
            ':now' => $now,
        ]);

        Response::json(['ok' => true, 'id' => $id, 'updated_at' => $now]);
    }
}
