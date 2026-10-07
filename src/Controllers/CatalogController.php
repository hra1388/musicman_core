<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Database;
use PDO;

class CatalogController
{
    public function search(Request $request): void
    {
        $term = trim((string)$request->getParam('term', ''));
        if (empty($term)) {
            Response::json(['resultCount' => 0, 'results' => [], 'source' => 'database']);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM tracks WHERE track_name LIKE :q OR artist_name LIKE :q LIMIT 50");
        $stmt->execute([':q' => '%' . $term . '%']);
        $tracks = $stmt->fetchAll();

        foreach ($tracks as &$track) {
            $track['wrapperType'] = 'track';
            $track['_source'] = 'database';
        }

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }

    public function suggest(Request $request): void
    {
        $q = trim((string)$request->getParam('q', ''));
        if (empty($q)) {
            Response::json(['success' => true, 'query' => '', 'count' => 0, 'suggestions' => []]);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT track_id AS id, track_name AS name, artist_name, 'track' AS type FROM tracks WHERE track_name LIKE :q OR artist_name LIKE :q LIMIT 10");
        $stmt->execute([':q' => '%' . $q . '%']);
        $suggestions = $stmt->fetchAll();

        Response::json(['success' => true, 'query' => $q, 'count' => count($suggestions), 'suggestions' => $suggestions]);
    }

    public function lookup(Request $request): void
    {
        $idStr = (string)$request->getParam('id', '');
        if (empty($idStr)) {
            Response::error('Missing id parameter', 400);
        }

        $ids = array_filter(array_map('trim', explode(',', $idStr)));
        if (empty($ids)) {
            Response::json(['resultCount' => 0, 'results' => []]);
        }

        $db = Database::getConnection();
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $db->prepare("SELECT * FROM tracks WHERE track_id IN ($placeholders)");
        $stmt->execute(array_values($ids));
        $tracks = $stmt->fetchAll();

        foreach ($tracks as &$track) {
            $track['wrapperType'] = 'track';
            $track['_source'] = 'database';
        }

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }

    public function artistTracks(Request $request): void
    {
        $artistId = (string)$request->getParam('id', $request->getParam('artistId', ''));
        if (empty($artistId)) {
            Response::error('Missing artist id', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM tracks WHERE artist_id = :aid LIMIT 100");
        $stmt->execute([':aid' => $artistId]);
        $tracks = $stmt->fetchAll();

        Response::json(['resultCount' => count($tracks), 'results' => $tracks]);
    }

    public function lyricsGet(Request $request): void
    {
        $trackId = (string)$request->getParam('id', '');
        if (empty($trackId)) {
            Response::error('Missing track id', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT interaction_value FROM user_interactions WHERE entity_type = 'track' AND entity_id = :tid AND interaction_type = 'lyrics' LIMIT 1");
        $stmt->execute([':tid' => $trackId]);
        $row = $stmt->fetch();

        if (!$row || empty($row['interaction_value'])) {
            Response::json(['success' => false, 'error' => 'Lyrics not found']);
        }

        Response::json(['success' => true, 'trackId' => $trackId, 'lyrics' => json_decode($row['interaction_value'], true)]);
    }

    public function lyricsSave(Request $request): void
    {
        $trackId = (string)$request->getParam('id', '');
        $lyrics = $request->getParam('lyrics', '');

        if (empty($trackId) || empty($lyrics)) {
            Response::error('Missing track id or lyrics', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO user_interactions (user_id, entity_type, entity_id, interaction_type, interaction_value, created_at)
            VALUES (1, 'track', :tid, 'lyrics', :val, :now)
            ON DUPLICATE KEY UPDATE interaction_value = VALUES(interaction_value)
        ");
        $stmt->execute([
            ':tid' => $trackId,
            ':val' => is_string($lyrics) ? $lyrics : json_encode($lyrics),
            ':now' => time(),
        ]);

        Response::json(['success' => true, 'message' => 'Lyrics saved']);
    }

    public function trackSave(Request $request): void
    {
        $trackId = (string)$request->getParam('track_id', $request->getParam('trackId', ''));
        $trackName = (string)$request->getParam('track_name', $request->getParam('trackName', ''));
        $artistId = (string)$request->getParam('artist_id', $request->getParam('artistId', ''));
        $artistName = (string)$request->getParam('artist_name', $request->getParam('artistName', ''));

        if (empty($trackId)) {
            Response::error('Missing track_id', 400);
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO tracks (track_id, track_name, artist_id, artist_name)
            VALUES (:tid, :tn, :aid, :an)
            ON DUPLICATE KEY UPDATE track_name = VALUES(track_name), artist_name = VALUES(artist_name)
        ");
        $stmt->execute([
            ':tid' => $trackId,
            ':tn' => $trackName,
            ':aid' => $artistId,
            ':an' => $artistName,
        ]);

        Response::json(['success' => true, 'message' => 'Track metadata saved']);
    }

    public function batch(Request $request): void
    {
        $this->lookup($request);
    }

    public function fresh(Request $request): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM tracks ORDER BY track_id DESC LIMIT 20");
        $tracks = $stmt->fetchAll();

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }

    public function popular(Request $request): void
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM tracks ORDER BY views DESC LIMIT 20");
        $tracks = $stmt->fetchAll();

        Response::json(['resultCount' => count($tracks), 'results' => $tracks, 'source' => 'database']);
    }
}
